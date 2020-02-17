<?php
class ConnexionController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
    }
    
    /**
     * Charge les fonctions utilise pour
     * le formulaire(present dans la vue)
     * puis charge la vue de la page
     *
     * @uses $this->load->helper()
     * @uses $this->load->view()
     *
     * @return void
     **/
    public function index() {
        $this->load->helper('form');
        $this->load->view('connexion');
    }
    
    public function connexion(){
        $this->load->database();
        
        
        $infos_professeur = $this->db->query('SELECT nom, email, motDePasse FROM enseignant');
        $infos_professeur = $infos_professeur->result_array()[0];
        
        $this->load->view('accueil');
      
        
    }
}