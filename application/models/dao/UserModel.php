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
    
    
    private $tableEnseignant = 'enseignant';
    private $tableEleve = 'eleve';
    private $cookieName = "189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD";
    private $emailFieldName = 'email';
    
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
        $user = $this->_getUserFromTable($this->tableEnseignant, $email);
        if (isset($user->motDePasse)) {
            $this->type = $this->tableEnseignant;
            return $this->encrypt->decode($user->motDePasse);
        }

        /* -----CHECK IF ETUDIANT----- */
        $user = $this->_getUserFromTable($this->tableEleve, $email);
      
        if (isset($user->motDePasse)) {
            $this->type = $this->tableEleve;
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
            $this->emailFieldName,
            'motDePasse'
        ))
        ->get_where($table, array(
            $this->emailFieldName => $email
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
        $user = $this->_getUserFromTable($this->tableEleve, $oldmail);
        
        if($user != null){
            //alors on update l'email d'un eleve
            if($newPassword !== ''){
                $this->changePassword($this->tableEleve, $oldmail, $newPassword);
            }
                
            if($newmail !== ''){
                $this->changeEmail($oldmail, $this->tableEleve, $newmail);
            }
        } else{
            $user = $this->_getUserFromTable($this->tableEnseignant, $oldmail);
            
            if($user != null){         
                //alors on update l'email d'un enseignant
                if($newPassword !== ''){
                    $this->changePassword($this->tableEnseignant, $oldmail, $newPassword);
                }
                
                if($newmail !== ''){
                    $this->changeEmail($oldmail, $this->tableEnseignant, $newmail);
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
        $this->db->where($this->emailFieldName, $oldmail);
        $updateUser = $this->db->update($table, array(
            $this->emailFieldName => $newmail
        ));
        
        $cookie = $this->_cookie;
        $cookie['name'] = $this->cookieName;
        $cookie['value'] = $this->encrypt->encode($newmail);
        if($updateUser){
            //on modifie les cookie de connexion
            delete_cookie($this->cookieName);
            delete_cookie($this->cookieName, '', '/', "ux_e");
            $cookie['prefix'] = ($table === $this->tableEleve) ? "ux_e": "ux_ad_";
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
        
        $this->db->where($this->emailFieldName, $oldmail);
        $this->db->update($table, $data);
    }
}