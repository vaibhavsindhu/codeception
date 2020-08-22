<?php
namespace Page\Api;

class SweepPath
{
    
    public function callSweepPath(\FunctionalTester $I){
    	$url="http://".$I->readConfigFile("domain").".".$I->readConfigFile("environment").".pch.com/api/sweeps/"."pchcom/"."desktop/paths";
		echo $url;
		$I->haveHttpHeader('Content-Type', 'application/json');
		$I->haveHttpHeader('Pch-Api-Auth-Bypass-Token', '5d14454300cad0083743747691f56b40');
		$I->sendGET($url);
		$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
		$response = $I->grabResponse();
		#echo $response;
  }

    public function validateJsonData(\FunctionalTester $I){
		$I->seeResponseContains('"status":"success"');
		$I->seeResponseContainsJson([
		  'error' => [
		      'code' => 0,
		      'message' => ''
		  ]
		]);
	

		$I->seeResponseMatchesJsonType([
		    'status' => 'string'
		]);
	
		$I->seeResponseMatchesJsonType(['id' => 'integer',
			'title'=>'string',
			'alias'=>'string',
	    	'start'=>'string',
	      	'end'=>'string|null',
	      	'feature_area'=>'string|null',
	      	'thumbnail'=>'string|null',
	      	'icon'=>'string|null',
	      	'tokens'=>'integer',
	      	'gwy_no'=>'string',
	      	'crmn'=>'string',
	      	'reg_url'=>'string'
		], '$.data[0]');

    }

}