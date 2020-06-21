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