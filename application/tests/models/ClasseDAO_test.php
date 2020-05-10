<?php
class ClasseDAO_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('dao/ClasseDAO');
        $this->obj = $this->CI->ClasseDAO;
    }
    
    public function test_getListClasse()
    {
        $classes = $this->obj->getListClasse();
        $this->assertEquals(1, $classes[0]["id"]);
        $this->assertEquals('L3 MIAGE APP', $classes[0]["nom"]);
        $this->assertEquals(2, $classes[1]["id"]);
        $this->assertEquals('M1 MIAGE APP', $classes[1]["nom"]);
        $this->assertEquals(3, $classes[2]["id"]);
        $this->assertEquals('M2 MIAGE APP', $classes[2]["nom"]);
    }
    
    public function test_getClasseById()
    {
        $classe = $this->obj->getClasseById(1);
        $this->assertEquals(1, $classe->getId());
        $this->assertEquals('L3 MIAGE APP', $classe->getNom());
    }
    
}