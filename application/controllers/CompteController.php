<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompteController extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('encrypt');
        
        $this->load->library('session');
        $this->load->helper('form');
    }
    
    
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
        $this->load->view('compte');
    }
    
    public function hasChange(){
        if($this->input->post('email') != $this->email){
            $this->changeEmail($this->input->post('email'));
        }
        redirect(site_url("compte"));
    }
    
    public function changeEmail($email){
        $this->db->update('eleve', array('email' => $email));
        
    }
    
}