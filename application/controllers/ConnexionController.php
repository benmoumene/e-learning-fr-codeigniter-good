<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ce controller est le controller gérant la partie
 * connexion pour les etudiants et la professeur
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class ConnexionController extends CI_Controller
{
    private $_cookie = array(
        'expire' => '86500',
        'path' => '/'
    );

    private $_cookiesId = array(
        "name" => "189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD",
        "password" => "1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS"
    );

    /**
     * Charge les fonctions utilisees
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->library('encrypt');
        $this->load->helper('form');
        /*MODEL USER PERMETTANT DE VERIFIER SI LES IDENTIFIANTS
         * CORRESPONDENT A UN ETUDIANT OU A LA PROFESSEUR
         * */
        $this->load->model('user_model');
    }

    /**
     * Charge la vue connexion
     * 
     * @return void
     */
    public function index()
    {
        $this->load->view('connexion');
    }

    /**
     * permet de verifier les identifiants
     * et de donner acces à
     * l'enseignante ou à un etudiant(via des cookies)
     * uniquement si les identifiants sont
     * correct
     *
     * @uses $this->setCookieForUser
     * @uses redirect()
     * @uses get_cookie()
     * @uses $this->user_model->validate()
     *      
     * @return void
     */
    public function connexion()
    { 
        if ($this->input->post('email', TRUE) && $this->input->post('mdp', TRUE)) {
            if ($this->user_model->validate($this->input->post('email'), $this->input->post('mdp'))) {
                /*--ON INITIALISE LES COOKIES--*/
                $this->setCookieForUser('name', $this->input->post('email'));
                $this->setCookieForUser('password', $this->input->post('mdp'));
                /*-----------------------------*/
                
                $this->redirect(false, "accueil");
            } else {
                $this->redirect();
            }
        } elseif (get_cookie($this->config->item('cookie_prefix') . $this->_cookiesId['name'], TRUE) && get_cookie($this->config->item('cookie_prefix') . $this->_cookiesId['password'], TRUE)) {
            $mail = $this->encrypt->decode(get_cookie($this->config->item('cookie_prefix') . $this->_cookiesId['name']));
            $password = $this->encrypt->decode(get_cookie($this->config->item('cookie_prefix') . $this->_cookiesId['password']));
            
            $hasFailed = false;
            if ($this->user_model->validate($mail, $password) == FALSE)
                $hasFailed = true;
                
            $this->redirect($hasFailed);
        } elseif ($this->router->fetch_class() != "connexion") {
            $this->redirect();
        }
    }
    
    /**
     * permet de rediriger l'user vers 
     * une page si la connexion a échouée
     * l'user est renvoye à la page de
     * connexion
     * 
     * @param boolean $hasFailed
     * @param string $url
     * 
     * @uses $this->session->set_flashdata()
     * @uses redirect()
     * 
     * @return void
     */
    private function redirect($hasFailed = true, $url = "connexion"){
        if($hasFailed)
            $this->session->set_flashdata("unable_to_connect", "La connexion a échouée");
        redirect(site_url($url));
    }
    
    /**
     * function pour creer un cookie pour
     * soit un enseignant ou un eleve
     * (seul le prefix change)
     * 
     * @param string $typeCookie
     * @param string $inputValue
     * 
     * @return void
     */
    private function setCookieForUser(string $typeCookie, string $inputValue){
        $cookie = $this->_cookie;
        $cookieId =$this->_cookiesId;
        $cookie['name'] = $cookieId[$typeCookie];
        $cookie['value'] = $this->encrypt->encode($inputValue);
        
        //var_dump($this->user_model);
        $cookie['prefix'] = ($this->user_model->type === "enseignant") ? $this->config->item('cookie_prefix') : "ux_e";
        set_cookie($cookie);
    }
   
}