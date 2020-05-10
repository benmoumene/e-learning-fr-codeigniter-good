<?php

class Document_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('entity/Document');
        $this->obj = $this->CI->Document;
    }
    
    public function test_getNom()
    {
        $nom = 'document1';
        $this->obj->setNom($nom);
        $this->assertEquals($nom, $this->obj->getNom());
    }
    
    public function test_getPath()
    {
        $path = '/upload/document1.pdf';
        $this->obj->setPath($path);
        $this->assertEquals($path, $this->obj->getPath());
    }
    
    public function test_getStatus()
    {
        $this->assertEquals(true, $this->obj->getStatus());
        $this->obj->setStatus(false);
        $this->assertEquals(false, $this->obj->getStatus());
    }
    
}