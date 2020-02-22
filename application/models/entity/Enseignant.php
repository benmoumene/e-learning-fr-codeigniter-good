<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
    /**
     * @Entity
     */
    class Enseignant{
        /**
         * @Id
         * @Column(type="integer")
         * @GeneratedValue
         */
		private $id;
		/** 
		 * @Column(type="string", nullable = false) 
		 */
		private $nom;
		/**
		 *  @Column(type="string", nullable = false) 
		 */
		private $email;
		/**
		 *  @Column(type="string", nullable = true)
		 */
		private $motDePasse;
		
		
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
		 * Get email
		 *
		 * @return string
		 */
		public function getEmail()
		{
		    return $this->email;
		}
		
		public function setEmail($email)
		{
		    $this->email = $email;
		}
		
		/**
		 * Get mot de passe
		 *
		 * @return string
		 */
		public function getMotDePasse()
		{
		    return $this->motDePasse;
		}
		
		public function setMotDePasse($motDePasse)
		{
		    $this->motDePasse = $motDePasse;
		}
    }
    
    ?>