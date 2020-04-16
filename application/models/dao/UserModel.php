<?php

if (! defined('BASEPATH')){
    exit('No direct script access allowed');
}

/**
 * Ce model sert à gérer la partie connexion(vérifier les identifiants)
 * et égalemment à la modification des informations d'un utilisateur
 * (quand ce dernier est connecté)
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class UserModel extends CI_MODEL
{
    private $_cookie = array(
        'expire' => '86500',
        'path' => '/'
    );
    
    
    private $_table = "enseignant";

    public $type = "";

    function __construct()
    {
        $this->load->library('encrypt');
    }

    /**
     * valide que les identifiants
     * entrees dans le formulaire
     * sont ceux de l'admin(enseignant)
     *
     * @uses $this->load->_getUser()
     *      
     * @return bool
     */
    public function validate($email, $motDePasse)
    {
        if (($passwd_crypt = $this->_getUser($email)) !== FALSE) {
            return (bool) ($motDePasse == $passwd_crypt);
        }
        return false;
    }

    /**
     * retourne la valeur booleenne
     * du decryptage du mot de passe
     * saisie par l'utilisateur
     *
     * @uses $this->_getUserFromTable()
     * @uses $this->encrypt->decode()
     *      
     * @return bool
     */
    public function _getUser($email)
    {
        /* -----CHECK IF ADMIN(ENSEIGNANT)----- */
        $user = $this->_getUserFromTable($this->_table, $email);
        if (isset($user->motDePasse)) {
            $this->type = "enseignant";
            return $this->encrypt->decode($user->motDePasse);
        }

        /* -----CHECK IF ETUDIANT----- */
        $user = $this->_getUserFromTable("eleve", $email);
      
        if (isset($user->motDePasse)) {
            $this->type = "eleve";
            return $this->encrypt->decode($user->motDePasse);
        }

        /* -----RETURN FALSE IF NOT ADMIN AND NOT ELEVE----- */
        return false;
    }
    
    /**
     * get email & mot de passe d'un user(en fonction de la table soit eleve soit enseignant)
     * en fonction de l'email(where de la requete) passé en parametre
     * 
     * @param string $table
     * @param string $email
     * @return $this->db->select()->row
     */
    public function _getUserFromTable(string $table, string $email){
        return $this->db->select(array(
            'email',
            'motDePasse'
        ))
        ->get_where($table, array(
            'email' => $email
        ))
        ->row();
    }
    
    /**
     * fonction permettant d'update les infos de l'utilisateur
     * (lorsque ce dernier est connecté et accède à son compte)
     * 
     * @param string $oldmail
     * @param string $newmail
     *
     * @uses $this->_getUserFromTable()
     * @uses $this->changeEmail()
     * @uses $this->changePassword()
     */
    public function updateUserDetails(string $oldmail, string $newmail, string $newPassword){
        $user = $this->_getUserFromTable('eleve', $oldmail);
        
        if($user != null){
            //alors on update l'email d'un eleve
            if($newPassword !== ''){
                $this->changePassword('eleve', $oldmail, $newPassword);
            }
                
            if($newmail !== ''){
                $this->changeEmail($oldmail, "eleve", $newmail);
            }
        } else{
            $user = $this->_getUserFromTable('enseignant', $oldmail);
            
            if($user != null){         
                //alors on update l'email d'un enseignant
                if($newPassword !== ''){
                    $this->changePassword('enseignant', $oldmail, $newPassword);
                }
                
                if($newmail !== ''){
                    $this->changeEmail($oldmail, "enseignant", $newmail);
                }
                
            }
        }
    }
    
    /**
     * update l'email d'un user(soit eleve soit enseignant)
     * et update le cookie(contenant l'email du user connecté)
     * 
     * @param string $oldmail
     * @param string $table
     * @param string $newmail
     */
    private function changeEmail(string $oldmail, string $table, string $newmail){
        $this->db->where('email', $oldmail);
        $updateUser = $this->db->update($table, array(
            'email' => $newmail
        ));
        
        $cookie = $this->_cookie;
        $cookie['name'] = "189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD";
        $cookie['value'] = $this->encrypt->encode($newmail);
        if($updateUser){
            //on modifie les cookie de connexion
            delete_cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD");
            delete_cookie("189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD", '', '/', "ux_e");
            $cookie['prefix'] = ($table === "eleve") ? "ux_e": "ux_ad_";
            set_cookie($cookie);
        }
    }
    
    /**
     * Permet de changer le mot de passe
     * d'un utilisateur(Eleve ou Enseignant)
     * 
     * @param string $table
     * @param string $oldmail
     * @param string $newPassword
     */
    private function changePassword(string $table, string $oldmail, string $newPassword){
        $data = array(
            'motDePasse' => $this->encrypt->encode($newPassword)
        );
        
        $this->db->where('email', $oldmail);
        $this->db->update($table, $data);
    }
}