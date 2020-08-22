<?php
namespace Page\Api;

class LoginGetSet
{
    private $email;
    private $gmt;
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setGmt($gmt){
        $this->gmt = $gmt;
    }
   
    public function getEmail(){
        return $this->email;
    }
 
    public function getGmt(){
        return $this->gmt;
    }

}
