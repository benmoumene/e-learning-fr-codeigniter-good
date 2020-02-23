<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MotDePasseOublieController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
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
        
        $this->load->view('motdepasseoublie');
    }
    
    public function send_password()
    {
        $this->db->select('email');
        $this->db->select('motDePasse');
        $this->db->from('eleve');
        $this->db->where('email', $this->input->post("email") );
        
        
        $eleve = $this->db->get();
        
        if ( $eleve->num_rows() > 0 )
        {
            $row = $eleve->row_array();
            $this->sendEmail($row['email'], $row['motDePasse']);
            $this->session->set_flashdata("envoie_mdp","Vos identifiants ont été envoyés sur votre boîte mail.");
        }
        else{
            $this->session->set_flashdata("envoie_mdp","Aucun compte n'est associé à cette adresse email");
        }
        $this->load->view("motdepasseoublie");
    }
    
    private function sendEmail($email, $mdp){
        //Load email library
        $this->load->library('email');
        $this->load->helper('cookie');
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_user'] = 'tt9814023@gmail.com';
        $config['smtp_pass'] = 'monmotdepasse99';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $config['smtp_crypto'] = 'ssl';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        
        $this->load->library('encrypt');
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject("Site du cours UX : demande de mot de passe");
        $this->email->message("Vous avez demandé votre mot de passe pour vous connecter sur le site du cours UX, voici vos identifiants : <br>  <b>Email : </b>".$email."<br>   <b>Mot de passe : </b>".$this->encrypt->decode($mdp));
        
        
        //Send mail
        if($this->email->send()){
            
        }
        
    }
}
