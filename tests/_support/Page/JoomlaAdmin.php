<?php
namespace Page;
use \Codeception\Step\Argument\PasswordArgument;
class JoomlaAdmin
{
	private static $ArticleManager = '//span[text()="Article Manager"]';
	private static $usernameField = 'username';
    private static $passwordField = 'passwd';
    private static $loginButton = 'Log in';
	private static $ArticleManagerCatergoryDropDown = 'select[name=filter_category_id]';
    #private static $CheckAllToggle = '//input[@name="checkall-toggle"]';
    #private static $ToolbarPublish ='toolbar-publish';

	use FunctionalTester;
	
    public function login($I)
    {
        $this->amOnUrl($this->readConfigFile("JoomlaUrl"));
        $joomlaAdmin = new JoomlaAdmin($this);
        $username = $this->readConfigFile("joomlaUsername");
        $password = $this->readConfigFile("joomlaPassword");      
        $I->fillField(self::$usernameField,  $username);
        $I->fillField(self::$passwordField, new PasswordArgument($password));
        $I->click(self::$loginButton);
       		
    }

	public function NavigateToArticleManager()
    {
    	$I = $this->tester;
    	$I->maximizeWindow();
		$I->click(self::$ArticleManager);
		$I->waitPageLoad();
	}
	
	public function selectCategrory($value)
    {
        $I = $this->tester;
		$I->selectOption(self::$ArticleManagerCatergoryDropDown,  array('value' => $value));
	}	
}