<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * une classe a plusieurs etudiants
     *
     * @OneToMany(targetEntity="Evaluation", mappedBy="eleve")
     */
    private $evaluations;

    
    public function __construct($nom = "", $prenom = "", $email = "", $classe = "")
    {
        date_default_timezone_set('Europe/Paris');
        $this->dateCreation = new DateTime();
        $this->evaluations = new ArrayCollection();
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setClasse($classe);
    }

    /**
     * @return array
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     *
     * @param array $evaluations
     */
    public function setEvaluations($evaluations)
    {
        $this->evaluations = $classe;
    }

    /**
     *
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     *
     * @param int $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     *
     * @return DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     *
     * @param DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }
}

?>