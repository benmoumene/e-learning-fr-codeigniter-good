<?php
class CoursDAO_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('dao/CoursDAO');
        $this->obj = $this->CI->CoursDAO;
    }
    
    public function test_getListCours()
    {
        $cours = $this->obj->getListCours();
        $this->assertEquals("cours IHM 1", $cours[0]["intitule"]);
    }
    
    public function test_getCoursById()
    {
        $cours = $this->obj->getCoursById(69);
        $this->assertEquals("cours IHM 1", $cours["intitule"]);
    }
    
    public function test_getListCoursByIdClasse(){
        $cours = $this->obj->getListCoursByIdClasse(3);
        $this->assertEquals("zdq", $cours[0]["intitule"]);
    }
}