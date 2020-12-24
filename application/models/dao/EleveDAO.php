<?php
if (! defined('BASEPATH')){
    exit('No direct script access allowed');
}
/**
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class EleveDAO extends CI_MODEL
{

    function __construct()
    {}
    
    function getListElevesByClasseId(){
        $this->db->select("id, nom, prenom, email");
        $this->db->from("eleve");
        $this->db->where("classe_id = ".$this->input->get('classe'));
        return $this->db->get()->result_array();
    }
    

    function getIdByEmail($email)
    {
        return $this->db->select('*')
            ->where('email', $email)
            ->limit(1)
            ->get('eleve')
            ->row()->id;
    }

    function getEleveByEmail($email)
    {
        return $this->getEleveObjectById($this->getIdByEmail($email));
    }

    /**
     * Doit etre appelé dans le cadre d'une transaction doctrine
     *
     * @param unknown $id
     * @return unknown
     */
    function getEleveObjectById($id)
    {
        return $this->doctrine->em->find("Eleve", intval($id));
    }
}