<?php
class ClasseDAO_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('dao/QuizDAO');
        $this->obj = $this->CI->QuizDAO;
    }
    
    public function test_getQuizList()
    {
        $quiz = $this->obj->getQuizList();
        $this->assertEquals("QCM1", $quiz[0]["nom"]);
    }
    
    public function test_getQuizListByIdClasse(){
        $quiz = $this->obj->getQuizListByIdClasse(1);
        $this->assertEquals("QCM1", $quiz[0]["nom"]);
        $this->assertEquals("quiz1", $quiz[1]["nom"]);
    }
    
    public function test_getQuestionsByQuizId(){
        $questions = $this->obj->getQuestionsByQuizId(11);
        $this->assertEquals("question1", $questions[0]["intitule"]);
        $this->assertEquals("question2", $questions[1]["intitule"]);
    }
    
    public function test_getReponsesByQuestionId(){
        $reponses = $this->obj->getReponsesByQuestionId(1);
        $this->assertEquals("AWT", $reponses[0]["contenu"]);
        $this->assertEquals("SWING", $reponses[1]["contenu"]);
        $this->assertEquals("Je ne sais pas", $reponses[2]["contenu"]);
    }
}