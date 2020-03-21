<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ce controller est le controller de la rubrique accueil
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class Accueil extends CI_Controller
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
    }

    /**
     * charge la vue de l'accueil
     *
     * @return void
     */
    public function index()
    {
        $this->load->view('accueil');
    }
}
