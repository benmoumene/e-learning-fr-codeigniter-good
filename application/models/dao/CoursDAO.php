<?php

if (! defined('BASEPATH')){
    exit('No direct script access allowed');
}
    
/**
 * 
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class CoursDAO extends CI_MODEL
{
    private $table = "cours";
    
    function __construct()
    {
    }
    
    function getListCours(){
        $this->db->select("*");
        $this->db->from($this->table);
        
        return $this->db->get()->result_array();
    }
    
    function getCoursById($id){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("id", $id);
        
        return $this->db->get()->result_array()[0];
    }
    
    function getListCoursByIdClasse($idClasse){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('cours_classe', 'cours.id = cours_classe.cours_id');
        $this->db->where('classe_id', $idClasse);
        
        return $this->db->get()->result_array();
    }
    
}