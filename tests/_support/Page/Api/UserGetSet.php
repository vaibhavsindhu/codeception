<?php
namespace Page\Api;

class UserGetSet
{
    private $email;
    private $gmt;
    private $oat;
    private $userid;
    
    public function setEmail($email){
        $this->email = $email;       
    }
    public function getEmail(){
        return $this->email;
    }

    public function setGmt($gmt){
        $this->gmt = $gmt;
    }
    public function getGmt(){
        return $this->gmt;
    }   
    
    public function getOat(){
        return $this->oat;
    }
    public function setOat($oat){
        $this->oat = $oat;
    }

    public function getUserid(){
        return $this->userid;
    }
    public function setUserid($userid){
        $this->userid = $userid;
    }

    private static $instance;
 
    // The singleton method
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            self::$instance = new UserGetSet();
        }
        return self::$instance;
    }

}