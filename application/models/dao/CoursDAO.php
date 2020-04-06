<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    
/**
 * 
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