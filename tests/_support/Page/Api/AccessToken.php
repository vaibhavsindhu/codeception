<?php
namespace Page\Api;

class AccessToken
{
   	public static $grant_type = 'client_credentials';

   
    private $client_id;
    private $client_secret;

	public function setClient_id($client_id){
        $this->client_id = $client_id;
    }
    
    public function setClient_secret($client_secret){
        $this->client_secret = $client_secret;
    }
   
    public function getClient_id(){
        return $this->client_id;
    }
 
    public function getClient_secret(){
        return $this->client_secret;
    }
	

}
