<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ce controller est le controller de la rubrique enseignements
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class EnseignementsController extends CI_Controller
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
    }
    
    /**
     * charge la vue de l'accueil
     *
     * @return void
     */
    public function index()
    {
        $this->load->library('encrypt');
        
        if($_SESSION['user'] == 'admin'){
            //on recupere tous les cours
            $data["coursList"] = $this->CoursDAO->getListCours();
        } else if($_SESSION['user'] == 'etudiant'){
            /*on recupere seulement les cours 
            de la classe de l'etudiant connecté*/
            $email = $this->encrypt->decode(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'));
            $this->db->select("classe_id");
            $this->db->from("eleve");
            $this->db->where("email", $email);
            $idClasse = intval($this->db->get()->result_array()[0]["classe_id"], 10);
            
            $data["coursList"] = $this->CoursDAO->getListCoursByIdClasse($idClasse);
        }
        
        //on recupere les documents par cours(Dictionnaire)
        $data["documents"] = $this->DocumentDAO->getDocumentsList();
        
        $data["quizzes"] = $this->QuizDAO->getQuizList();
        
        // on recupere les id des cours de chaque document
        $idsCours = array();
        foreach ($data["documents"] as $document) {
            array_push($idsCours, $document['cours_id']);
        }
        $data["idsCours"] = $idsCours;
        
        $this->load->view('enseignements', $data);
    }
}
