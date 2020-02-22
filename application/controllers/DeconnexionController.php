<?php
class DeconnexionController extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->library('session');
        $this->load->helper('cookie');
        delete_cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD");
        delete_cookie("1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS");
        unset($_COOKIE['key']);
        redirect(site_url("accueil"));
    }
}

?>