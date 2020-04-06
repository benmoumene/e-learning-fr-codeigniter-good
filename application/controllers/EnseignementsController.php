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
    }
    
    /**
     * charge la vue de l'accueil
     *
     * @return void
     */
    public function index()
    {
        $data["coursList"] = $this->CoursDAO->getListCours();
        
        //on recupere les documents par cours(Dictionnaire)
        $data["documents"] = $this->DocumentDAO->getDocumentsList();
        
        $this->load->view('enseignements', $data);
    }
}
