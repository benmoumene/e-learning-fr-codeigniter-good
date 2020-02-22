<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_model extends CI_MODEL{
    
    private $_table = "enseignant";
    
    function __construct() {
        $this->load->library('encrypt');
    }
    
    public function validate($email, $motDePasse) {
        if (($passwd_crypt = $this->_getUser($email)) !== FALSE)
            return (bool) ($motDePasse == $passwd_crypt);
            return false;
    }
    
    private function _getUser($email) {
        $user = $this->db->select(array('email', 'motDePasse'))->get_where($this->_table, array('email' => $email))->row();
        if (isset($user->motDePasse))
            return $this->encrypt->decode($user->motDePasse);
            return false;
    }
}