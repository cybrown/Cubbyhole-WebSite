<?php

namespace Cubbyhole\WebApiBundle\Service;

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
        try {
            return $this->serializer->deserialize($response->getContent(), "Cubbyhole\WebApiBundle\Entity\Account", 'json');
        } catch (\Exception $ex) {
            return null;
        }
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
    
}
