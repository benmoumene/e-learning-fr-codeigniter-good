<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    
/**
 * Ce model sert à gérer la partie connexion(vérifier les identifiants)
 * et égalemment à la modification des informations d'un utilisateur
 * (quand ce dernier est connecté)
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class CoursDAO extends CI_MODEL
{
    
    function __construct()
    {
    }
    
    function getListCours(){
        $this->db->select("*");
        $this->db->from("cours");
        
        return $this->db->get()->result_array();
    }
    
}