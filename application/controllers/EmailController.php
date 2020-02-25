<?php
class EmailController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('session');
        $this->load->helper('form');
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
        $this->load->helper('form');
        $this->load->view('contact');
    }
	
	/**
	 * Envoi un email sur l'adresse mail configure
	 * par $this->email->to($config['smtp_user']);
	 *
	 * $config['smtp_user'] etant le mail destinee à recevoir
	 * les messages envoyees a partir du formulaire
	 *
	 * @uses $this->input->post()
	 * @uses $this->load->library()
	 * @uses $this->email->initialize()
	 * @uses $this->email->set_newline()
	 * @uses $this->email->from()
	 * @uses $this->email->to()
	 * @uses $this->email->subject()
	 * @uses $this->email->message()
	 * @uses $this->email->send()
	 * @uses $this->session->set_flashdata()
	 * @uses $this->load->view()
	 *
	 * @return void
	**/
    public function send_mail() {
        $from_email = $this->input->post('email');
        //Load email library
        $this->load->library('email');
		
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'tt9814023@gmail.com';
		$config['smtp_pass'] = 'monmotdepasse99';
		$config['smtp_port'] = 465;
		$config['smtp_crypto'] = 'ssl';
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
		
        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to($config['smtp_user']);
        $this->email->subject($this->input->post('subject'));
        $this->email->message($this->input->post('message'));
        //Send mail
        if($this->email->send())
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        else
            $this->session->set_flashdata("email_sent","You have encountered an error");
        $this->load->view('contact');
    }
}
