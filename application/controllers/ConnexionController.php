<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ConnexionController extends CI_Controller {
    private $_cookie = array(
        // 'name'   => '',
        // 'value'  => '',
        'expire' => '86500',
        // 'domain' => '.some-domain.com',
        'path'   => '/',
        // 'prefix' => '',
    );
    
    private $_cookie_id_name = "189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD"; // nom d'un cookie
    private $_cookie_id_password = "1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS"; // nom d'un cookie
    
    function __construct() {
        parent::__construct();
        $this->load->library('session');
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
        $this->load->helper('cookie');
        
        $this->load->helper('form');
        $this->session->flashdata('import_success');
        $this->load->view('connexion');
    }
    
    /**
     * permet de verifier les identifiants
     * et de donner acc�s �
     * l'administrateur(via des cookies) 
     * uniquement si les identifiants sont
     * correct
     * 
     * @uses $this->load->helper()
     * @uses $this->load->library()
     * @uses $this->load->model()
     * @uses $this->input->post()
     * @uses $this->encrypt->encode()
     * @uses $this->config->item()
     * @uses set_cookie()
     * @uses redirect()
     * @uses site_url()
     * @uses get_cookie()
     * @uses $this->encrypt->decode()
     * $this->administrator_model->validate()
     *
     * @return void
     **/
    public function connexion(){
        $this->load->helper('cookie');
        $this->load->library('encrypt');
        $this->load->model('administrator_model');
        
        if ($this->input->post('email', TRUE) && $this->input->post('mdp', TRUE))
        {
            if ($this->administrator_model->validate($this->input->post('email'), $this->input->post('mdp')))
            {
                $cookies_email = $this->_cookie;
                $cookies_email['name'] = $this->_cookie_id_name;
                $cookies_email['value'] = $this->encrypt->encode($this->input->post('email'));
                // $cookies_email['domain'] = "";
                $cookies_email['prefix'] = ($this->administrator_model->type == "enseignant") ? $this->config->item('cookie_prefix') : "ux_e";
                set_cookie($cookies_email);
                
                $cookies_password = $this->_cookie;
                $cookies_password['name'] = $this->_cookie_id_password;
                $cookies_password['value'] = $this->encrypt->encode($this->input->post('mdp'));
                // $cookies_email['domain'] = "";
                $cookies_password['prefix'] = ($this->administrator_model->type == 'enseignant') ? $this->config->item('cookie_prefix') : "ux_e";
                set_cookie($cookies_password);
                
                // Tout est ok, ont redirige vers la page d'accueil de l'admin
                redirect(site_url("accueil"));
            }
            else
            {
                $this->session->set_flashdata("unable_to_connect","La connexion a échouée");
                // Mauvais email, ont redirige vers la page de connexion
                redirect(site_url("connexion"));
            }
        }
        elseif (get_cookie($this->config->item('cookie_prefix').$this->_cookie_id_name, TRUE) &&
            get_cookie($this->config->item('cookie_prefix').$this->_cookie_id_password, TRUE))
        {
            $mail = $this->encrypt->decode(get_cookie($this->config->item('cookie_prefix').$this->_cookie_id_name));
            $password = $this->encrypt->decode(get_cookie($this->config->item('cookie_prefix').$this->_cookie_id_password));
            if ($this->administrator_model->validate($mail, $password) == FALSE)
                $this->session->set_flashdata("unable_to_connect","La connexion a échouée");
                redirect(site_url("connexion")); // Mauvais email, ont redirige vers la page de connexion
        }
        elseif ($this->router->fetch_class() != "connexion")
        {
            $this->session->set_flashdata("unable_to_connect","La connexion a échouée");
            redirect(site_url("connexion"));
        }
       
    }
}