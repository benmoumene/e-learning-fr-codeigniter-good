<?php
use Doctrine\Common\Collections\ArrayCollection;
require './vendor/autoload.php';

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    
    /**
     *
     * @Entity
     */
    class Classe
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
        private $nom;
        
        /**
         * une classe a plusieurs etudiants
         *
         * @OneToMany(targetEntity="Eleve", mappedBy="cours", cascade="persist")
         */
        private $etudiants;
        /**
         * Many Classe have Many Cours.
         * @ManyToMany(targetEntity="Cours", mappedBy="classes")
         */
        private $cours;
        
        
        public function __construct()
        {
            $this->etudiants = new ArrayCollection();
            $this->cours = new ArrayCollection();
        }
        
        /**
         * @return mixed
         */
        public function getNom()
        {
            return $this->nom;
        }
    
        /**
         * @param mixed $nom
         */
        public function setNom($nom)
        {
            $this->nom = $nom;
        }
    
        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
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
       
        
        /**
         * Get etudiants
         *
         * @return array
         */
        public function getEtudiants()
        {
            return $this->etudiants;
        }
        
        public function setEtudiants($etudiants)
        {
            $this->etudiants = $etudiants;
        }
        /**
         * @return mixed
         */
        public function getCours()
        {
            return $this->cours;
        }
    
        /**
         * @param mixed $cours
         */
        public function setCours($cours)
        {
            $this->cours = $cours;
        }
     
    }
    
    ?>