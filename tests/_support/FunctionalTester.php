<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/

use Page\JoomlaAdmin as JoomlaAdmin;
use Page\Api\SweepPath as SweepPath;

class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

   	
	 /**
     * @Given I login to Joomla
     */
     public function iLoginToJoomla()
     {
        $this->amOnUrl($this->readConfigFile("JoomlaUrl"));
        $joomlaAdmin = new JoomlaAdmin($this);
        $username = $this->readConfigFile("joomlaUsername");
        $password = $this->readConfigFile("joomlaPassword");
		$joomlaAdmin->login($username, $password);
     }

     /**
     * @When I login up I should see the active sweep :arg1 article
     */
     public function iLoginUpIShouldSeeTheActiveSweepArticle($arg1)
     {
        $joomlaAdmin = new JoomlaAdmin($this);
        $joomlaAdmin->NavigateToArticleManager();

        if($arg1=="desktop"){
             $joomlaAdmin->selectCategrory(59);
        }else if($arg1=="mobile"){
            $joomlaAdmin->selectCategrory(60);
        }

        if ($this->seePageHasElement('//span[text()="Published"]')) {
          echo "Active Publish Article Present";
         }else{
            echo "No Active Published Article";
         }   
     }



    /**
     * @When I Call the Sweep Path API
     */
     public function iCallTheSweepPathAPI()
     {
        $sweepPath = new SweepPath($this);
        $sweepPath->callSweepPath($this);
     }

    /**
     * @Then I validated the json data type and respnse type
     */
     public function iValidatedTheJsonDataTypeAndRespnseType()
     {
        $sweepPath = new SweepPath($this);
        $sweepPath->validateJsonData($this);
     }
	

}
