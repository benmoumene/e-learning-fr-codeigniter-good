<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

use Doctrine\Common\Collections\ArrayCollection;
    
/**
 * @Entity
 */
class Quiz
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /**
     * @Column(type="string", unique = true, nullable = false)
     */
    private $nom;
    /**
     * Many Quiz have Many Classe.
     * @ManyToMany(targetEntity="Classe", inversedBy="quizzes")
     * @JoinTable(name="quiz_classe")
     */
    private $classes;
    /**
     * un Quiz a plusieurs Question
     *
     * @OneToMany(targetEntity="Question", mappedBy="quiz", cascade="persist")
     */
    private $questions;
    
    
    
    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param array $classes
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }
    /**
     * @return array
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param array $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

}
?>