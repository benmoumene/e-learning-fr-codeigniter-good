<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';
use SMTPValidateEmail\Validator as SmtpEmailValidator;

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
        $this->load->model('dao/user_model');
        /*
         * user_model a une methode permettant de retourner
         * le mot de passe d'un user(etudiant ou enseignant)
         */
        $user = $this->user_model->_getUser($this->input->post("email"));

        if ($user) {
            $validator = new SmtpEmailValidator($this->input->post("email"), "tt9814023@gmail.com");
            $results   = $validator->validate();    
            
            if($results[$this->input->post("email")]){
                //l'adresse mail renseignée peut recevoir des mails
                $this->sendEmail($this->input->post("email"), $user);
                $this->session->set_flashdata("envoie_mdp", "Vos identifiants ont été envoyés sur votre boîte mail.");
            } else{
                $this->session->set_flashdata("envoie_mdp", "Cette adresse mail n'est liée à aucun compte.");
            }
        } else {
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
     *
     * @uses $this->load->library()
     */
    private function sendEmail(string $email, string $mdp)
    {
        $subject = "Site du cours UX : demande de mot de passe";
        $message = "Vous avez demandé votre mot de passe pour vous connecter sur le site du cours UX, voici vos identifiants : <br><br>&emsp;  <b>Email : </b>" . $email . "<br>&emsp;   <b>Mot de passe : </b>" . $mdp;

        $params = array(
            $email,
            $subject,
            $message
        );
        $this->load->library('EmailSender', $params);
    }
}
