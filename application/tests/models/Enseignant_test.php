<?php

class Enseignant_test extends TestCase{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('entity/Enseignant');
        $this->obj = $this->CI->Enseignant;
    }
    public function test_get_mot_de_passe()
    {
        $motDePasse = 'motdepasse';
        $this->obj->setMotDePasse($motDePasse);
        $this->assertEquals($motDePasse, $this->obj->getMotDePasse());
    }
    
    public function test_get_email()
    {
        $email = 'test@gmail.fr';
        $this->obj->setEmail($email);
        $this->assertEquals($email, $this->obj->getEmail());
    }
    
    public function test_get_nom()
    {
        $nom = 'familyname test';
        $this->obj->setNom($nom);
        $this->assertEquals($nom, $this->obj->getNom());
    }
    
    public function test_get_prenom()
    {
        $prenom = 'name test';
        $this->obj->setPrenom($prenom);
        $this->assertEquals($prenom, $this->obj->getPrenom());
    }
}