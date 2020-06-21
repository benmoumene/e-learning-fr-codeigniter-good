<?php

if (! defined('BASEPATH')){
    exit('No direct script access allowed');
}
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
    
    function getQuizListByIdClasse($id){
        $this->db->select("*");
        $this->db->from("quiz");
        $this->db->join("quiz_classe", "quiz.id=quiz_classe.quiz_id");
        $this->db->where("classe_id", $id);
        
        return $this->db->get()->result_array();
    }
    
    function getQuestionsByQuizId($id){
        $this->db->select("*");
        $this->db->from("question");
        $this->db->where("quiz_id",$id);
        
        return $this->db->get()->result_array();
    }
    
    function getReponsesByQuestionId($id){
        $this->db->select("*");
        $this->db->from("reponse");
        $this->db->where("question_id",$id);
        
        return $this->db->get()->result_array();
    }
    
    function getTrueReponsesByQuestionId($id){
        $this->db->select("*");
        $this->db->from("reponse");
        $this->db->where("question_id",$id);
        $this->db->where("estVrai", 1);
        
        return $this->db->get()->result_array();
    }
    
    
}