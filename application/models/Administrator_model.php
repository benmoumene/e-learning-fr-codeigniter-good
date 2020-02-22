<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_model extends CI_MODEL{
    
    private $_table = "enseignant";
    public $type = "";
    
    function __construct() {
        $this->load->library('encrypt');
    }
    
    /**
     * valide que les identifiants 
     * entree dans le formulaire
     * sont ceux de l'admin(enseignant)
     *
     * @uses $this->load->_getUser()
     *
     * @return bool
     **/
    public function validate($email, $motDePasse) {
        var_dump($motDePasse);
        if (($passwd_crypt = $this->_getUser($email)) !== FALSE){
            echo 'VALIDATE RETUNR';
            return (bool) ($motDePasse == $passwd_crypt);
        }
        return false;
    }
    
    /**
     * retourne la valeur booleenne
     * du decryptage du mot de passe 
     * saisie par l'utilisateur
     *
     * @uses  $this->db->select()->get_where()->row()
     * @uses  $this->encrypt->decode()
     *
     * @return bool
     **/
    private function _getUser($email) {
        $user = $this->db->select(array('email', 'motDePasse'))->get_where($this->_table, array('email' => $email))->row();
        if (isset($user->motDePasse)){
            $this->type = "enseignant";
            return $this->encrypt->decode($user->motDePasse);
        }
        
        $user = $this->db->select(array('email', 'motDePasse'))->get_where("eleve", array('email' => $email))->row();
        if (isset($user->motDePasse)){
            $this->type = "eleve";
            return $this->encrypt->decode($user->motDePasse);
        }
        return false;
    }
}