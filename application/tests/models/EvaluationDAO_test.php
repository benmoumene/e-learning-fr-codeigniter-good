<?php
class EvaluationDAO_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('dao/EvaluationDAO');
        $this->obj = $this->CI->EvaluationDAO;
    }
    
    public function test_getEvaluationByQuizAndByEleve()
    {
        $evalutions = $this->obj->getEvaluationByQuizAndByEleve(1, 206);
        $this->assertEquals("1/2", $evalutions[0]["note"]);
    }
    
}