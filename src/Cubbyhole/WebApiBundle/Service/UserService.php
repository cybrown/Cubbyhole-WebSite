<?php

namespace Cubbyhole\WebApiBundle\Service;

class UserService
{
    private $baseUrl = 'http://localhost:3000/user';
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

    public function findUser($username,$password)
    {   
        return $this->serializer->deserialize($this->get("/".$username), "Cubbyhole\WebApiBundle\Entity\User", 'json');
    }
       private function get($path = '/')
    {
        $response = $this->browser->get($this->baseUrl.$path, [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password)
        ]);
        return $response->getContent();
    }
    

}


