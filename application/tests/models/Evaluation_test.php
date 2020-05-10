<?php

class Evaluation_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('entity/Evaluation');
        $this->obj = $this->CI->Evaluation;
    }
    
    public function test_date()
    {
        $date = new DateTime();
        $this->obj->setDate($date);
        $this->assertEquals($date, $this->obj->getDate());
    }
    
    public function test_get_appreciation()
    {
        $app = 'bien';
        $this->obj->setAppreciation($app);
        $this->assertEquals($app, $this->obj->getAppreciation());
    }
    
    public function test_get_note()
    {
        $note = '12/20';
        $this->obj->setNote($note);
        $this->assertEquals($note, $this->obj->getNote());
    }
    
}