<?php
class EleveDAO_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('dao/EleveDAO');
        $this->obj = $this->CI->EleveDAO;
    }
    
    /**
     * Ce test teste toute les méthodes de 
     * la classe EleveDao car la méthode
     * getEleveByEmail() appelle une autre méthode
     * de la même classe et elle retourne une autre
     * méthode(3 méthodes testés en tout)
     */
    public function test_getEleveByEmail()
    {
        $eleve = $this->obj->getEleveByEmail('mickaelgudin@gmail.com');
        $this->assertEquals('Gudin', $eleve->getNom());
        $this->assertEquals('Mickael', $eleve->getPrenom());
        $this->assertEquals('mickaelgudin@gmail.com', $eleve->getEmail());
    }
    
}