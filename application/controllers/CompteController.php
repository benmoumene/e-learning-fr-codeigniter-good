<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';
use SMTPValidateEmail\Validator as SmtpEmailValidator;
/**
 * Ce controller est le controller de la rubrique compte
 * permettant à l'utilisateur de modifier ses informations(son email, son mot de passe)
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class CompteController extends CI_Controller
{

    /**
     * Charge les fonctions utilise par
     * la page d'accueil et lance
     * la vue
     */
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('cookie');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->helper('form');
    }

    /**
     * Charge la vue de la compte.php
     *
     * @uses $this->load->view()
     *      
     * @return void
     */
    public function index()
    {
        $this->load->view('compte');
    }

    /**
     * Cette fonction permet de vérifier
     * que l'email entré et différent de l'email
     * actuel.
     *
     * @uses $this->input->post()
     * @uses $this->changeEmail()
     */
    public function hasChange()
    {
        $email = $this->input->post("email");
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            $validator = new SmtpEmailValidator($email, "tt9814023@gmail.com");
            $results   = $validator->validate();
            
            if($results[$email]){
                //on change l'adresse mail
                $this->changeEmail($email);
            }
            else{
                redirect(site_url("compte"));
            }
        } 
        
        $this->load->model('dao/UserModel');
        /*on change le mot de passe si il existe un user
        (Eleve ou Enseignant) avec les identifiants 
        renseignées*/
        if($this->UserModel->validate($email, $this->input->post('oldpassword'))){
            if($_POST['newpassword'] === $_POST['checknewpassword']){
                //on change le mot de passe
                $this->UserModel->updateUserDetails($this->input->post('email'), '', $_POST['newpassword']);
                $_SESSION['retour_modification'] = "Le mot de passe a été changé";
            } else{
                $_SESSION['retour_modification'] = "Veuillez saisir le même mot de passe";
            }
        } 
        
        else {
            $_SESSION['retour_modification'] = "Vérifiez l'email ou le mot de passe";
        }
        redirect(site_url("compte"));
    }

    /**
     * Cette methode appelle le model user
     * et lui demande de modifier l'email dans
     * la base de donnees
     *
     * @param string $email
     */
    public function changeEmail(string $newmail)
    {
        $this->load->model('dao/UserModel');
        /* si l'utilisateur connecté est un eleve alors le cookie(contenant email) commence par ux_e */
        $oldmail = $this->encrypt->decode(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'));

        if ($oldmail === '') {
            /* l'utilisateur connecté est un enseignant */
            $oldmail = $this->encrypt->decode(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'));
        }
        $this->UserModel->updateUserDetails($oldmail, $newmail, '');
    }
}