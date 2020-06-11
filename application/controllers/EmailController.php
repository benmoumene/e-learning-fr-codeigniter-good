<?php

require './vendor/autoload.php';
use SMTPValidateEmail\Validator as SmtpEmailValidator;

/**
 * Controller de la rubrique Contact
 * @author Mike
 */
class EmailController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
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
     */
    public function index()
    {
        $this->load->helper('form');
        $this->load->view('contact');
    }

    /**
     * Envoi un email sur l'adresse mail configure
     * par la library EmailSender
     * (dans le dossier application/library)
     * $config['smtp_user'] etant le mail destinee à recevoir
     * les messages envoyees a partir du formulaire
     *      
     * @return void
     */
    public function send_mail()
    {
        $params = array(
            $this->input->post('email'),
            $this->input->post('subject'),
            $this->input->post('message'),
            $this->input->post('email')
        );
                
        $validator = new SmtpEmailValidator($this->input->post("email"), "tt9814023@gmail.com");
        $results = $validator->validate();
        
        if (isset($results[$this->input->post("email")])){
            $this->load->library('EmailSender', $params);
            $this->session->set_flashdata("email_sent", "Votre message a bien été envoyé.");
        }
        else{
            $this->session->set_flashdata("email_sent", "Veuillez vérifier la saisie des champs.");
        }
            
        $this->load->view('contact');
    }
}
