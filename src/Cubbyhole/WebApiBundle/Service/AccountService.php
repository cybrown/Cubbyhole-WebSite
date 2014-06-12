<?php

namespace Cubbyhole\WebApiBundle\Service;

use Buzz\Browser;
use Cubbyhole\WebApiBundle\Entity\Account;
use Exception;

class AccountService
{
    private $baseUrl = 'http://localhost:3000/accounts';
    private $browser;
    private $username;
    private $password;
    private $serializer;

    function __construct($username, $password, $serializer)
    {
        $this->username = $username;
        $this->password = $password;
        $this->serializer = $serializer;
    }
    
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }
    
    public function whoami($username, $password)
    {
        $response = $this->browser->get($this->baseUrl . "/whoami", [
            "Authorization" => "Basic ".base64_encode($username . ":" . $password)
        ]);
        //try {
           
        return $this->serializer->deserialize($response->getContent(), "Cubbyhole\WebApiBundle\Entity\Account", 'json');
        //} catch (Exception $ex) {
          //  return null;
        //}
    }

    public function findOne($id)
    {   
        return $this->serializer->deserialize($this->get("/".$id), "Cubbyhole\WebApiBundle\Entity\Account", 'json');
    }
    
    private function get($path = '/')
    {
        $response = $this->browser->get($this->baseUrl.$path, [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password)
        ]);
        return $response->getContent();
    }
    
     public function create(Account $account){
        $browser = new Browser();
        $browser->put($this->baseUrl."/", [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password),
            "Content-Type" => "application/json"
        ], $this->serializer->serialize($account, "json"));
    }
    
    public function delete(Account $account){
         $browser = new Browser();
        $browser->delete($this->baseUrl."/".$account->getId(), [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password),
            "Content-Type" => "application/json"
        ], $this->serializer->serialize($account, "json"));
    }
}
