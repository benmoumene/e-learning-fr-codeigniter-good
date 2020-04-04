<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ce controller est le controller de la rubrique publications
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class PublicationController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('session');
    }
    
    /**
     * charge la vue de publication
     *
     * @return void
     */
    public function index()
    {
        $this->load->view('publication');
    }
}