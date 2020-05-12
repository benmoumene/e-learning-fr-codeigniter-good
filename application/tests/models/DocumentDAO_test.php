<?php
class DocumentDAO_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('dao/DocumentDAO');
        $this->obj = $this->CI->DocumentDAO;
    }
    
    public function test_getListCours()
    {
        $documents = $this->obj->getDocumentsList();
        $this->assertEquals("cours1.pdf", $documents[0]["nom"]);
    }
}