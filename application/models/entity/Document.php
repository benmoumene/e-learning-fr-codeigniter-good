<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @Entity
 */
class Document
{
    /**
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     *
     * @Column(type="string", nullable = false)
     */
    private $nom;

    /**
     *
     *  @Column(type="string", nullable = false)
     */
    private $path;
    
    /**
     *
     *  @Column(type="boolean")
     */
    private $status = true;
    
    /**
     * Un document concerne un cours
     *
     * @ManyToOne(targetEntity="Cours", inversedBy="documents")
     * @JoinColumn(nullable=true, name="cours_id", referencedColumnName="id")
     */
    private $cours;
    

    public function __construct()
    {}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get cours
     *
     * @return string
     */
    public function getCours()
    {
        return $this->cours;
    }

    public function setCours($cours)
    {
        $this->cours = $cours;
    }
    
    /**
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
 
}

?>