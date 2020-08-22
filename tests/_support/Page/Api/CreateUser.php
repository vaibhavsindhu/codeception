<?php
namespace Page\Api;

use Page\Api\UserGetSet as UserGetSet;

class CreateUser 
{
   
	protected $tester;

    #public function __construct(\ApiTesterActions $this)
   # {
    #    $this->tester = $this;
    #}
    
	public function fullRegUser()
    {
		
        $rfFull_url = $this->readConfigFile("rfFull_url");		
	
        $myfile = file_get_contents("D:\FullReg.json");
		$userGetSet = UserGetSet::singleton();
		
		$myfile = str_replace("FirstName", $this->generateRandomString(5), $myfile);
		$myfile = str_replace("LastName", $this->generateRandomString(5), $myfile);
		$myfile = str_replace("EmailId", "phpctrl".$this->generateRandomString(5)."@pchmail.com", $myfile);
		
		$this->haveHttpHeader('Content-Type', 'application/json');
		$this->sendPOST($rfFull_url,$myfile);
		$this->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $this->seeResponseIsJson();
		$response = $this->grabResponse();
		echo $response;
		//$userGetSet = new UserGetSet();
#		$userGetSet = UserGetSet::singleton();



		$userGetSet->setGmt($this->grabDataFromResponseByJsonPath("$.MemberDetailStatusResponse.MemberDetailResponse.GlobalMemberToken")[0]);
		
		$userGetSet->setEmail($this->grabDataFromResponseByJsonPath("$.MemberDetailStatusResponse.MemberDetailResponse.Email")[0]);

		$userGetSet->setOat($this->grabDataFromResponseByJsonPath("$.MemberDetailStatusResponse.MemberDetailResponse.OnlineAccountToken")[0]);

		$this->haveHttpHeader('Content-Type', 'application/json');
		$this->sendGET("http://userapi.qa.pch.com/api/user/".$userGetSet->getEmail()."/".$userGetSet->getOat());
		$this->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
    	$this->seeResponseIsJson();
		$response = $this->grabResponse();
		echo $response;
    
		$userGetSet->setUserid($this->grabDataFromResponseByJsonPath("$.data.id")[0]);

		return $userGetSet;
	}

}