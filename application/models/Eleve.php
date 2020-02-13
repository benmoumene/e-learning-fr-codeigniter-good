<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** @Entity */
 class Eleve{
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
}

?>