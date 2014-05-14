<?php

namespace Cubbyhole\WebApiBundle\Service;

class PlanService
{
    private $baseUrl = 'http://localhost:3000/plans';
    private $browser;
    private $username;
    private $password;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }

    public function findAll() 
    {
        return $response = $this->get();
    }
    
    public function findOne($id)
    {
        return $response = $this->get("/".$id);
    }
    
    private function get($path = '/')
    {
        $response = $this->browser->get($this->baseUrl.$path, [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password)
        ]);
        return json_decode($response->getContent());
    }
}
