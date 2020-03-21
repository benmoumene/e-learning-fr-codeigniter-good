<?php

class EmailSender
{
    protected $CI;
    
    /**
     * Library qui initialise un mail et l'envoi,
     * les parametres de l'array sont(email, subject, message)
     * 
     * @param array $params
     * @return boolean
     */
    public function __construct($params)
    {
        $this->CI =& get_instance();
        // Load email library
        $this->CI->load->library('email');
    
        /*on appel le fichier de config email(non natif) qui contient un
         * tableau de config pour envoyer des emails
         * */
        $email = $params[0];
        $subject = $params[1];
        $message = $params[2];
        $from = '';
        //utiliser par la partie Contact
        if(sizeof($params) === 4)
            $from = $params[3];
        
        $this->CI->config->load('email');
        $config = $this->CI->config->item('email');
        $this->CI->email->initialize($config);
        $this->CI->email->set_newline("\r\n");
        if($from === ''){
            $this->CI->email->from($config['smtp_user']);
            $this->CI->email->to($email);
        }
        else{
            $this->CI->email->from($from);
            $this->CI->email->to($config['smtp_user']);
        }
        
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        if ($this->CI->email->send()) {
            return true;
        }
        return false;
    }
    
   
}