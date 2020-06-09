<?php
use Doctrine\Common\Collections\ArrayCollection;
require './vendor/autoload.php';

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @Entity
 */
class Cours
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
     * @Column(type="string", nullable=false)
     */
    private $intitule;
    
    /**
     *
     * @Column(type="text", nullable=true)
     */
    private $description = 'Pas encore de description pour ce cours';
   
    /**
     *
     * @Column(type="boolean")
     */
    private $status = true;
    
    
    /**
     * un cours a plusieurs documents
     *
     * @OneToMany(targetEntity="Document", mappedBy="cours")
     */
    private $documents;
    
    /**
     * Many Cours have Many Classe.
     * @ManyToMany(targetEntity="Classe", inversedBy="cours", cascade={"persist"})
     * @JoinTable(name="cours_classe")
     */
    private $classes;
    

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

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
    public function getIntitule()
    {
        return $this->intitule;
    }

    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    }

    /**
     * Get documents
     *
     * @return array
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }
    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }

    /**
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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