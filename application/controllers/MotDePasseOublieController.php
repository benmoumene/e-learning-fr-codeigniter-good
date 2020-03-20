<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ce controller est le controller de la rubrique 
 * mot de passe oubliée dans la page de connexion
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class MotDePasseOublieController extends CI_Controller
{
    /**
     * Charge les fonctions utilisees
     * par la vue
     *
     * @uses $this->load->helper()
     * @uses $this->load->library()
     * @uses $this->load->view()
     *
     * @return void
     */
    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('session');
        $this->load->helper('form');
    }

    /**
     * Charge la vue
     * 
     * @uses $this->load->view()
     *
     * @return void
     */
    public function index()
    {
        $this->load->view('motdepasseoublie');
    }

    /**
     * cette fonction verifie
     * que l'email entre correspond
     * à celui d'un eleve
     * 
     * @uses $this->load->model()
     * @uses $this->user_model->_getUser()
     * @uses $this->sendEmail()
     * 
     */
    public function send_password()
    {
        $this->load->model('user_model');
        /* 
          user_model a une methode permettant de retourner 
          le mot de passe d'un user(etudiant ou enseignant)
        */
        $user = $this->user_model->_getUser($this->input->post("email"));
        
        if ($user) {
            $this->sendEmail($this->input->post("email"), $user);
            $this->session->set_flashdata("envoie_mdp", "Vos identifiants ont été envoyés sur votre boîte mail.");
        } else{
            $this->session->set_flashdata("envoie_mdp", "Cette adresse mail n'est liée à aucun compte.");
        }
        $this->load->view("motdepasseoublie");
    }

    /**
     * Cette fonction permet d'envoyer
     * un mail à l'utilisateur(eleve ou enseignant)
     * avec son mot de passe 
     * 
     * @param string $email
     * @param string $mdp
     */
    private function sendEmail(string $email, string $mdp)
    {
        $this->load->library('email');
        $this->load->helper('cookie');
        /*on appel le fichier de config email(non natif) qui contient un
         * tableau de config pour envoyer des emails
         * */
        $this->config->load('email');
        
        $config = $this->config->item('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->load->library('encrypt');
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject("Site du cours UX : demande de mot de passe");
        $this->email->message("Vous avez demandé votre mot de passe pour vous connecter sur le site du cours UX, voici vos identifiants : <br><br>&emsp;  <b>Email : </b>" . $email . "<br>&emsp;   <b>Mot de passe : </b>" . $mdp);

        // Send mail
        if ($this->email->send()) {}
    }
}
