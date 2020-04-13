<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    
/**
 *
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class EvaluationDAO extends CI_MODEL
{
    
    function __construct()
    {
    }
    
    function getEvaluationByQuizAndByEleve($quiz, $eleve){
        $this->db->select("*");
        $this->db->from("evaluation");
        $this->db->where("quiz_id", $quiz);
        $this->db->where("eleve_id", $eleve);
        
        return $this->db->get()->result_array();
    }
    
    function persistEvaluation($evaluation){
        $this->doctrine->em->persist($evaluation);
        $this->doctrine->em->flush();
        $this->doctrine->em->commit();
    }
    
}
