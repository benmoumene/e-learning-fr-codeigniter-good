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
    }
    
    /**
     * charge la vue de l'accueil
     *
     * @return void
     */
    public function index()
    {
        $this->session->set_flashdata("coursList", $this->CoursDAO->getListCours());
        $this->load->view('enseignements');
    }
}
