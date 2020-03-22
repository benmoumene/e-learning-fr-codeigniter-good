<?php

class Eleve_test extends TestCase{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('entity/Eleve');
        $this->obj = $this->CI->Eleve;
    }
    
    public function test_get_random_password(){
        $passwords_generated = array();
        
        for($i = 0; $i<200; $i++){
            array_push($passwords_generated, $this->obj->get_random_password());
        }
        
        /*ON VERIFIE QUE CHAQUE PASSWORD GENERE EST PRESENT QU'UNE
         * FOIS DANS NOTRE ARRAY POUR TESTER LA ROBUSTESSE DE NOTRE FONCTION*/
        $this->assertEquals(sizeof(array_count_values($passwords_generated)), sizeof($passwords_generated));
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