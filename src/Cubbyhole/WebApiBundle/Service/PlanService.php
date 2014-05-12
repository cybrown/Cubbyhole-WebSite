<?php

namespace Cubbyhole\WebApiBundle\Service;

use Buzz\Browser;

class PlanService
{
    public function findAll() 
    {
        $browser = new Browser();
        $response = $browser->get('http://localhost:3000/plans', [
            "Authorization" => "Basic dXNlcjpwYXNz"
        ]);
        return json_decode($response->getContent());
    }
}

