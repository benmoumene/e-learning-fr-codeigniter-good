<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    
    /**
     *
     *
     * @author Mickael GUDIN <mickaelgudin@gmail.com>
     */
    class ClasseDAO extends CI_MODEL
    {
        
        function __construct()
        {
        }
        
        function getListClasse(){
            $this->db->select("*");
            $this->db->from("classe");
            
            return $this->db->get()->result_array();
        }
        
        function getClasseById($id){
            $this->db->select("*");
            $this->db->from("classe");
            $this->db->where("id = ".$id);
            $classeData = $this->db->get()->result_array()[0];
            $classe = new Classe();
            $classe->setId($classeData['id']);
            $classe->setNom($classeData['nom']);
            
            return $classe;
        }
        
    }