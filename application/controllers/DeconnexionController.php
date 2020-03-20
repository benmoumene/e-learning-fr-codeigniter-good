<?php

/**
 * Ce controller est le controller qui 
 * gére la déconnexion des utilisateurs(enseignant ou etudiant)
 * connectés
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class DeconnexionController extends CI_Controller
{
    /**
     * Charge les fonctions utilisees par
     * la déconnexion
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
    }

    /**
     * function qui supprime les cookies de connexion 
     * existants et enfin redirige vers l'accueil
     *
     * @uses delete_cookie()
     * @uses redirect()
     *      
     * @return void
     */
    public function index()
    {
        delete_cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD");
        delete_cookie("1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS");
        delete_cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD", '', '/', "ux_e");
        delete_cookie("1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS", '', '/', "ux_e");
        redirect(site_url("accueil"));
    }
}
?>