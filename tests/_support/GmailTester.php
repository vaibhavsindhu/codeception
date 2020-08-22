<?php
use Page\JoomlaAdmin as JoomlaAdmin;

class GmailTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

 
 /**
     * @Given I login to gmail
     */
     public function iLoginToGmail()
    {
       $this->amOnUrl("https://www.google.com");
  }


   /**
     * @Given I login to google
     */
     public function iLoginToGoogle()
    {
    echo "****************** Google";
  }
}