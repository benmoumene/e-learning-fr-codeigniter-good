<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
        $this->changeEmail($this->input->post('email'));
        
        redirect(site_url("compte"));
    }

    /**
     * Cette methode appelle le model Eleve
     * et lui demande de modifier l'email dans
     * la base de donnees
     *
     * @param string $email
     */
    public function changeEmail(string $newmail)
    {
        $this->load->model('user_model');
        /*si l'utilisateur connecté est un eleve alors le cookie(contenant email) commence par ux_e*/
        $oldmail = $this->encrypt->decode(get_cookie('ux_e189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'));
        
        if($oldmail === ''){
            /*l'utilisateur connecté est un enseignant*/
            $oldmail = $this->encrypt->decode(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'));
        }
        $this->user_model->updateUserDetails($oldmail, $newmail);
    }
}