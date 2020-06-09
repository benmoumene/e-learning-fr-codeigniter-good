<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @Entity
 */
class Evaluation
{
    /**
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /**
     *  @Column(type="datetime", nullable = false)
     */
    private $date;
    /**
     * @Column(type="string", nullable = true)
     */
    private $appreciation;
    /**
     * @Column(type="string", nullable = false)
     */
    private $note;
    /**
     * une Evalutation peut avoir un Quiz.
     * @OneToOne(targetEntity="Quiz")
     * @JoinColumn(name="quiz_id", referencedColumnName="id", nullable = true, onDelete="CASCADE")
     */
    private $quiz;
    /**
     * Une Evaluation concerne un Eleve
     *
     * @ManyToOne(targetEntity="Eleve", inversedBy="evaluations")
     * @JoinColumn(name="eleve_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private $eleve;
    
    
    public function __construct()
    {
        date_default_timezone_set('Europe/Paris');
        $this->date = new DateTime();
    }
    
    /**
     * @return Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }
    /**
     * @param Eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getAppreciation()
    {
        return $this->appreciation;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param string $appreciation
     */
    public function setAppreciation($appreciation)
    {
        $this->appreciation = $appreciation;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @param Quiz $quiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;
    } 
 
}

?>