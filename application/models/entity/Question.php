<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

use Doctrine\Common\Collections\ArrayCollection;
    
/**
* @Entity
*/
class Question
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /**
     * @Column(type="string", nullable = false)
     */
    private $intitule;
    /**
     * Une question concerne un quiz
     *
     * @ManyToOne(targetEntity="Quiz", inversedBy="questions")
     * @JoinColumn(nullable=true, name="quiz_id", onDelete="CASCADE", referencedColumnName="id")
     */
    private $quiz;
    /**
     * une Question a plusieurs Reponse
     *
     * @OneToMany(targetEntity="Reponse", mappedBy="question", cascade="persist")
     */
    private $reponses;
    
    public function __construct()
    {
        $this->reponses = new ArrayCollection();
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
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * @return Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @return array
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $intitule
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    }

    /**
     * @param Quiz $quiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * @param array $reponses
     */
    public function setReponses($reponses)
    {
        $this->reponses = $reponses;
    } 
}

?>