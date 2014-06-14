<?php

namespace Cubbyhole\WebApiBundle\Service;

class PlanService
{
    private $baseUrl = 'http://localhost:3000/plans';
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

    public function findAll() 
    {
        return $this->serializer->deserialize($this->get("/"), "array<Cubbyhole\WebApiBundle\Entity\Plan>", 'json');
    }
    
    public function findOne($id)
    {
        return $this->serializer->deserialize($this->get("/".$id), "Cubbyhole\WebApiBundle\Entity\Plan", 'json');
    }
    
    private function get($path = '/')
    {
        $response = $this->browser->get($this->baseUrl.$path, [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password)
        ]);
        return $response->getContent();
    }
    
    public function create($data){
        $browser = new \Buzz\Browser();
        $browser->put($this->baseUrl."/", [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password),
            "Content-Type" => "application/json"
        ], json_encode([
            "name" => $data->getName(),
            "price" => $data->getPrice(),
            "bandwidthDownload"=>$data->getBandwidthDownload(),
            "bandwidthUpload"=>$data->getBandwidthUpload(),
            "space"=>$data->getSpace(),
            "shareQuota"=>$data->getShareQuota()
                
        ]));
     
    }
        public function update($data){
        $browser = new \Buzz\Browser();
        $browser->post($this->baseUrl."/".$data->getId(), [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password),
            "Content-Type" => "application/json"
        ], json_encode([
            "name" => $data->getName(),
            "price" => $data->getPrice(),
            "bandwidthDownload"=>$data->getBandwidthDownload(),
            "bandwidthUpload"=>$data->getBandwidthUpload(),
            "space"=>$data->getSpace(),
            "shareQuota"=>$data->getShareQuota()
                
        ]));
     
    }
    
      public function delete($data){
        $browser = new \Buzz\Browser();
        $browser->delete($this->baseUrl."/".$data->getId(), [
            "Authorization" => "Basic ".base64_encode($this->username.":".$this->password),
            "Content-Type" => "application/json"
        ], json_encode([
            "name" => $data->getName(),
            "price" => $data->getPrice(),
            "bandwidthDownload"=>$data->getBandwidthDownload(),
            "bandwidthUpload"=>$data->getBandwidthUpload(),
            "space"=>$data->getSpace(),
            "shareQuota"=>$data->getShareQuota()
                
        ]));
      }
}
