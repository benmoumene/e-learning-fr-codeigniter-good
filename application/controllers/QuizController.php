<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Doctrine\Common\ClassLoader;

/**
 * Ce controller est le controller de la rubrique quiz
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class QuizController extends CI_Controller
{

    /**
     * Charge les fonctions utilisees par
     * la page d'accueil
     */
    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');

        $this->load->library('session');
        $this->load->model("dao/CoursDAO");
        $this->load->model("dao/DocumentDAO");
        $this->load->model("dao/QuizDAO");
        $this->load->model("dao/EleveDAO");
        $this->load->model("dao/EvaluationDAO");
        $this->load->library("encrypt");
        $this->load->helper('form');
    }

    /**
     * charge la vue de l'accueil
     *
     * @return void
     */
    public function index()
    {
        $this->load->library('encrypt');
        $idClasse = 0;

        if ($_SESSION['user'] == 'admin') {
            // on recupere tous les cours
            $data["coursList"] = $this->CoursDAO->getListCours();
        } else if ($_SESSION['user'] == 'etudiant') {
            /*
             * on recupere seulement les cours
             * de la classe de l'etudiant connecté
             */
            $email = $this->encrypt->decode(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'));
            $this->db->select("classe_id");
            $this->db->from("eleve");
            $this->db->where("email", $email);
            $idClasse = intval($this->db->get()->result_array()[0]["classe_id"], 10);

            $data["coursList"] = $this->CoursDAO->getListCoursByIdClasse($idClasse);
        }

        // on recupere les documents par cours(Dictionnaire)
        $data["documents"] = $this->DocumentDAO->getDocumentsList();

        if ($idClasse == 0) {
            $data["quizzes"] = $this->QuizDAO->getQuizList();
        } else {
            $data["quizzes"] = $this->QuizDAO->getQuizListByIdClasse($idClasse);
        }

        // on recupere les id des cours de chaque document
        $idsCours = array();
        foreach ($data["documents"] as $document) {
            array_push($idsCours, $document['cours_id']);
        }
        $data["idsCours"] = $idsCours;
            
        $this->load->model("dao/ClasseDAO");
        $data['classeList'] = $this->ClasseDAO->getListClasse();
        
        $this->load->view('quiz', $data);
    }

    public function checkQuizAnswers()
    {
        $reponsesByQuestionId = array();
        $score = 0;

        foreach ($_POST as $k => $p) {
            if (in_array($k, array('nombre_question', 'quiz_id'))){
                continue;
            }

            else if ($k === 'submit_quiz'){
                break;
            }

            $k = str_replace('optradio', '', $k);
            $k = explode('-', $k);
            $questionNumber = $k[0];
            $reponseNumber = $k[1];

            if (! array_key_exists($questionNumber, $reponsesByQuestionId)) {
                $reponsesByQuestionId[$questionNumber] = array();
            }
            array_push($reponsesByQuestionId[$questionNumber], $reponseNumber);
        }

        foreach ($reponsesByQuestionId as $k => $question) {
            $reponses = $this->QuizDAO->getTrueReponsesByQuestionId($k);
            $count = 0;

            $i = 0;
            foreach ($question as $reponse) {
                $count = ($reponse === $reponses[$i ++]["id"]) ?  $count+=1 : $count-=1;
            }

            if ($count === sizeof($reponses)) {
                $score ++;
            }
        }

        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
        
        $evaluation = new Evaluation();
        $evaluation->setNote("$score/" . $_POST['nombre_question']);
        $evaluation->setQuiz($this->doctrine->em->find("Quiz", intval($_POST['quiz_id'])));
        $evaluation->setEleve($this->EleveDAO->getEleveByEmail($this->encrypt->decode(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))));
        
        $this->load->model("dao/EvaluationDAO");
        $this->EvaluationDAO->persistEvaluation($evaluation);
        
        redirect(site_url("quiz?quiz=".$_POST['quiz_id']));
    }
    
    public function removeQuiz(){
        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
        $cours = $this->doctrine->em->find("Quiz", $this->input->post('quiz_id'));
        
        $this->doctrine->em->remove($cours);
        $this->doctrine->em->commit();
        $this->doctrine->em->flush();
        redirect(site_url("quiz"));
    }
    
    public function saveNewQuiz(){
        //insert new quiz
        if($this->input->post('quiz_id') === null || empty($_POST['classe_ids'])){
            $this->session->set_flashdata("creation_quiz", "Veuillez renseigner les champs");
            redirect(site_url("quiz?quiz=".$_POST['quiz_id']));
        }
        
        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
        
        $quiz = new Quiz();
        $quiz->setNom($_POST['quiz_name']);
        
        /*on prend les classes selectionnes pour le quiz 
          et on lui affecte*/
        $classes = array();
        for($i=0; $i<sizeof($_POST['classe_ids']); $i++){
            $classe = $this->doctrine->em->find("Classe", $_POST['classe_ids'][$i]);
            array_push($classes, $classe);
        }
        $quiz->setClasses($classes);
        $this->doctrine->em->persist($quiz);
        
        $questions = array();
        $reponses = array();
        
        //on recupere les reponses et les question
        foreach($_POST as $k => $p){
            if($k != 'nombre_question' && strpos($k, 'question') !== FALSE){
                $question = new Question();
                $question->setId(explode('-', $k)[1]);
                $question->setIntitule($_POST[$k]);
                $question->setQuiz($quiz);
                array_push($questions, $question);        
            }
            else if(strpos($k, 'reponse') !== FALSE){
                $reponse = new Reponse();
                $reponse->setContenu($_POST[$k]);
                
                $reponsesElements = explode('-', $k);
                $reponse->setQuestion($reponsesElements[1]);
                (isset($_POST['estvrai-'.$reponsesElements[1].'-'.$reponsesElements[2]]))? $reponse->setEstVrai(true) : $reponse->setEstVrai(false);
                
                array_push($reponses, $reponse);
            }
        }
        
        //on insere les questions et leurs reponses
        foreach ($questions as $question){
            $id_question = $question->getId();
            $this->doctrine->em->persist($question);
            foreach($reponses as $reponse){
                if($id_question == $reponse->getQuestion()){
                    $reponse->setQuestion($question);
                    $this->doctrine->em->persist($reponse);
                }
            }
        }
        
        $this->doctrine->em->flush();
        $this->doctrine->em->commit();
        
        $this->session->set_flashdata("creation_quiz", "Le quiz a été crée");
        redirect(site_url("quiz?quiz=".$_POST['quiz_id']));
    
    }
    
}
