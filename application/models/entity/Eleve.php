<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

include_once 'Personne.php';
/**
 *
 * @Entity
 */
class Eleve extends Personne
{
    /**
     *
     *  @Column(type="datetime", nullable = false)
     */
    private $dateCreation;
    
    /**
     * Un document concerne un cours
     *
     * @ManyToOne(targetEntity="Classe", inversedBy="etudiants")
     * @JoinColumn(nullable=true, name="classe_id", referencedColumnName="id")
     */
    private $classe;
    
    public function __construct()
    {
        date_default_timezone_set('Europe/Paris');
        $this->dateCreation = new DateTime();
    }
    
    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param int $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }
   
}

?>