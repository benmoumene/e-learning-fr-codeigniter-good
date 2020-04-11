<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    
/**
 *
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class QuizDAO extends CI_MODEL
{
    
    function __construct()
    {
    }
    
    function getQuizList(){
        $this->db->select("*");
        $this->db->from("quiz");
        
        return $this->db->get()->result_array();
    }
    
}