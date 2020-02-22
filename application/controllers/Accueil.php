<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {

    /**
     * Charge les fonctions utilise par
     * la page d'accueil et lance
     * la vue 
     *
     * @uses $this->load->helper()
     * @uses $this->load->library()
     * @uses $this->load->view()
     *
     *
     * @return void
     **/
	public function index()
	{
	    $this->load->helper('cookie');
	    $this->load->library('session');
		$this->load->view('accueil');
	}

}
