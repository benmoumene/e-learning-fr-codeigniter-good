<?php
class DeconnexionController extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Charge les fonctions utilises 
     * puis supprimer les cookie de l'administrateur
     * et enfin redirige vers l'accueil
     *
     * @uses $this->load->library()
     * @uses $this->load->helper()
     * @uses delete_cookie()
     * @uses redirect()
     * @uses site_url()
     *
     * @return void
     **/
    public function index() {
        $this->load->library('session');
        $this->load->helper('cookie');
        delete_cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD");
        delete_cookie("1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS");
        
        delete_cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD", '', '/', "ux_e");
        delete_cookie("1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS", '', '/', "ux_e");
        redirect(site_url("accueil"));
    }
}

?>