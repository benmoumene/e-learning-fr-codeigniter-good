<?php
if (! defined('BASEPATH'))
exit('No direct script access allowed');

/**
 * @Entity
 */
class Reponse
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
    private $contenu;
    /**
     * @Column(type="boolean", nullable = false)
     */
    private $estVrai;
    /**
     * Une question concerne un quiz
     *
     * @ManyToOne(targetEntity="Question", inversedBy="reponses")
     * @JoinColumn(nullable=true, name="question_id", onDelete="CASCADE", referencedColumnName="id")
     */
    private $question;
    
   
    public function __construct()
    {
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
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @return bool
     */
    public function getEstVrai()
    {
        return $this->estVrai;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @param bool $estVrai
     */
    public function setEstVrai($estVrai)
    {
        $this->estVrai = $estVrai;
    }
    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }
 
}

?>