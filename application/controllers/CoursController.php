<?php
defined('BASEPATH') || exit('No direct script access allowed');

use Doctrine\Common\ClassLoader;

/**
 * Controller de la rubrique
 * cours qui permet de visualiser
 * les cours et les documents associes
 * Elle permet aussi à l'enseignante 
 * de créer un cours, supprimer un cours,
 * ou ajouter des documents à un cours 
 * existant
 * @author Mike
 *
 */
class CoursController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('session');
        $this->load->helper('form');
        $this->doctrine->em->beginTransaction();
        
        $this->load->helper('cookie');
        
        $this->load->model("dao/CoursDAO");
        $this->load->model("dao/DocumentDAO");
        $this->load->model("dao/QuizDAO");
        $this->load->model("dao/EleveDAO");
        $this->load->model("dao/ClasseDAO");
        $this->load->model("dao/EvaluationDAO");
        $this->load->model("entity/Classe");
        $this->load->helper('form');
    }

    /**
     * Charge les fonctions utilise pour
     * le formulaire(present dans la vue)
     * puis charge la vue de la page
     * @uses $this->load->helper()
     * @uses $this->load->view()
     *      
     * @return void
     */
    public function index()
    {
        if ($_SESSION['user'] == '') {
            redirect(site_url('accueil'));
        }
        
        $this->load->model("dao/ClasseDAO");
        $data['classeList'] = $this->ClasseDAO->getListClasse();
                
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
        
        
        
        
        $this->load->model("dao/ClasseDAO");
        $data['classeList'] = $this->ClasseDAO->getListClasse();
        
        $array = array();
        foreach ($data["coursList"] as $cours) {

            $res = $this->ClasseDAO->getClasseForCoursId($cours['id']);
            if (!empty($res)) {
                $classeinfo = array();
                foreach ($res as $r) {
                    array_push($classeinfo, $this->ClasseDAO->getClasseById($r["classe_id"]));
                }
                array_push($array, $classeinfo);
            }
        }
        $this->load->view('cours', $data);
    }

    /**
     * creer un cours avec les documents 
     * associes
     *
     * @uses $this->load->model()
     * @uses $this->doctrine->em->persist()
     * @uses $this->do_upload()
     * @uses $this->doctrine->em->flush()
     *      
     * @return void
     */
    public function creer_cours()
    {
        if (empty($_FILES['files']['tmp_name'][0])) {
            $this->session->set_flashdata("cours_champ_required", "Veuillez saisir les champs requis");
            redirect(site_url("cours"));
        }
        
        $this->doctrine->refreshSchema();
        $this->doctrine->em->getConnection()->beginTransaction();
        
        // vérification que des champs requis
        if (empty($this->input->post('nom_cours')) || empty($this->input->post('classes_ids'))) {
            $this->session->set_flashdata("cours_champ_required", "Veuillez saisir les champs requis");
            redirect(site_url('cours'));
        }

        $cours = new Cours();
        
        $classes = array();
        for($i=0; $i<sizeof($_POST['classes_ids']); $i++){
            $classe = $this->doctrine->em->find("Classe", $_POST['classes_ids'][$i]);
            array_push($classes, $classe);
        }
        
        $cours->setClasses($classes);
        $cours->setIntitule($this->input->post('nom_cours'));
        if(!empty($this->input->post('description'))){
            $cours->setDescription($this->input->post('description'));
        }
        $this->doctrine->em->persist($cours);
        
        if (! empty($_FILES['files']['tmp_name'][0]) && $cours!==null) {
            $this->do_upload($cours);
        }
        $this->doctrine->em->commit();
        

        redirect(site_url("cours"));
    }

    public function getDocumentsByCours() {
        $documents = $this->DocumentDAO->getDocumentsListByCours($this->input->get('cours_id'));
        echo json_encode($documents);
    }
    
    public function getClassesByCours() {
        $classes = $this->ClasseDAO->getClasseForCoursId($this->input->get('cours_id'));
        echo json_encode($classes);
    }
    
    /**
     * permet d'ajouter des documents
     * a un cours existant
     * return @void
     */
    public function addDocuments(){
        $this->doctrine->refreshSchema();
        $this->doctrine->em->getConnection()->beginTransaction();
                
        $cours = $this->doctrine->em->find('Cours', $this->input->post('cours_id'));
        
        
        if(!empty($_FILES['files']['tmp_name'][0]) && $cours !== null){
            $this->do_upload($cours);
        }
        
        $this->doctrine->em->persist($cours);
        $this->doctrine->em->commit();
        
    }
    
    /**
     * permet d'upload les documents
     * joints à un cours
     * dans le dossier uploads
     * situé à la racine du projet
     *
     * @uses $this->load->model()
     * @uses $this->doctrine->em->persist()
     * @uses $this->do_upload()
     * @uses $this->doctrine->em->flush()
     *      
     * @return void
     */
    public function do_upload($cours)
    {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );

        $count = count($_FILES['files']['name']);
        $import = 'Le cours ';

        for ($i = 0; $i < $count; $i ++) {
            $config['file_name'] = $_FILES['files']['name'][$i];

            if (! empty($_FILES['files']['tmp_name'][$i])) {
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file')) {

                    $import .= 'a été importé';
                    $document = new Document();

                    $document->setCours($cours);
                    $document->setNom($_FILES['file']['name']);
                    $document->setPath("/projetL3/uploads/" . $_FILES['file']['name']);
                    $this->doctrine->em->persist($document);
                    
                } else {
                    /*
                     * SI L'UN DES DOCUMENTS N'EST PAS DE TYPE
                     * PDF ALORS ON FAIT UN ROLLBACK
                     * ET AUCUN COURS NI DOCUMENT N'EST CREE
                     */
                    $import = 'Les documents doivent être de type pdf';
                    $this->doctrine->em->rollback();
                }
            }
        }

        $this->doctrine->em->commit();
        $this->doctrine->em->flush();
    }
    
    /**
     * permet de modifier les classes d'un cours
     * return @void
     */
    public function modifyClasses(){
        $this->doctrine->refreshSchema();
        $cours = $this->doctrine->em->find("Cours", $this->input->post('cours_id'));
        
        
        
        $classes = array();
        if($cours!=null && !empty($_POST['classes_ids']) ){
            
            $result = json_decode($_POST['classes_ids'], true);
            foreach($result as $c){
                $classe = $this->doctrine->em->find("Classe", $c);
                array_push($classes, $classe);
            }
            
            if(!empty($classes)){
                $cours->setClasses($classes);
                $this->doctrine->em->persist($cours);
                $this->doctrine->em->commit();
                $this->doctrine->em->flush();
            }
        }
        var_dump($this->input->post('cours_id'));
        
       
    }
    
    /**
     * permet de supprimer un cours existant
     * return @void
     */
    public function removeCours(){
        $this->doctrine->refreshSchema();
        $cours = $this->doctrine->em->find("Cours", $this->input->post('cours_id'));
       
        if($cours!=null){
            foreach ($cours->getDocuments() as $d) {
                unlink('uploads/'.$d->getNom());
            }
        }

        $this->doctrine->em->remove($cours);
        $this->doctrine->em->commit();
        $this->doctrine->em->flush();
        redirect(site_url("cours"));
    }


    /**
     * permet de supprimer un document existant
     * return @void
     */
    public function removeDocument(){
        $this->doctrine->refreshSchema();
        $document = $this->doctrine->em->find("Document", $this->input->post('document_id'));
        
        if($document != null){
            unlink('uploads/'.$document->getNom());
            $this->doctrine->em->remove($document);
            $this->doctrine->em->commit();
            $this->doctrine->em->flush();
        }
    }

}

