<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I
use Codeception\Exception\ModuleException;

class ActionWrapper extends \Codeception\Module
{
	private $webDriver = null;
    private $webDriverModule = null;



 /**
     * Event hook before a test starts.
     *
     * @param \Codeception\TestCase $test
     *
     * @throws \Exception
     */
    public function _before(\Codeception\TestCase $test)
    {
        if (!$this->hasModule('WebDriver') && !$this->hasModule('Selenium2')) {
            throw new \Exception('PageWait uses the WebDriver. Please be sure that this module is activated.');
        }
        // Use WebDriver
        if ($this->hasModule('WebDriver')) {
            $this->webDriverModule = $this->getModule('WebDriver');
            $this->webDriver = $this->webDriverModule->webDriver;
        }
    }


	public function readConfigFile($key)
    {
		$url = 'C:\composer\vendor\bin\tests\functional\config.json';
		$data = file_get_contents($url); // put the contents of the file into a variable
		$characters = json_decode($data,true); // decode the JSON feed
	
		if(strpos($key,",") !== false) {			
			$splitArray = explode(",", $key);
			return $characters[$splitArray[0]][$splitArray[1]];			
		}else if(strpos($key,",") !== true) { //do not contain ,
			return $characters[$key];
		}
    }
	
	function generateRandomString($length = 10) {
		return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
	}

	function seePageHasElement($element)
	{
	    try {
	        $this->getModule('WebDriver')->_findElements($element);
	    } catch (\PHPUnit_Framework_AssertionFailedError $f) {
	        return false;
	    }
	    return true;
	}


   
   public function waitAjaxLoad($timeout = 10)
    {
        $this->webDriverModule->waitForJS('return !!window.jQuery && window.jQuery.active == 0;', $timeout);
        $this->webDriverModule->wait(1);
        $this->dontSeeJsError();
    }
    /**
     * @param $timeout
     */
    public function waitPageLoad($timeout = 10)
    {
        $this->webDriverModule->waitForJs('return document.readyState == "complete"', $timeout);
        $this->waitAjaxLoad($timeout);
        $this->dontSeeJsError();
    }

    /**
     *
     * @param $link
     * @param $timeout
     */
    public function amOnPage($link, $timeout = 10)
    {
        $this->webDriverModule->amOnPage($link);
        $this->waitPageLoad($timeout);
    }
    /**
     * @param $identifier
     * @param $elementID
     * @param $excludeElements
     * @param $element
     */
    public function dontSeeVisualChanges($identifier, $elementID = null, $excludeElements = null, $element = false)
    {
        if ($element !== false) {
            $this->webDriverModule->moveMouseOver($element);
        }
        $this->getModule('VisualCeption')->dontSeeVisualChanges($identifier, $elementID, $excludeElements);
        $this->dontSeeJsError();
    }
   

    public function dontSeeJsError()
    {
        $logs = $this->webDriver->manage()->getLog('browser');
        foreach ($logs as $log) {
            if ($log['level'] == 'SEVERE') {
                throw new ModuleException($this, 'Some error in JavaScript: ' . json_encode($log));
            }
        }
    }
}