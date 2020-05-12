<?php
class UserModel_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('dao/UserModel');
        $this->obj = $this->CI->UserModel;
    }
    
    /**
     * test validate(),getUser(),getUserFromTable()
     * car validate() appel getUser()
     * qui appel getUserFromTable()
     */
    public function test_validate()
    {
        $this->assertTrue($this->obj->validate("tt9814023@gmail.com","admin"));
        $this->assertTrue($this->obj->validate("mickaelgudin@gmail.com","eleve"));
    }
    
}