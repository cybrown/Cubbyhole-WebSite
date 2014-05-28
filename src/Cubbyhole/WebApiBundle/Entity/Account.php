<?php
namespace Cubbyhole\WebApiBundle\Entity;

use JMS\Serializer\Annotation\Type;

class Account
{
    /**
    * @Type("integer")
    */
    protected $id;

    /**
    * @Type("string")
    */
    protected $username;

    /**
    * @Type("string")
    */
    protected $password;

    /**
    * @Type("integer")
    */
    protected $plan;

    /**
    * @Type("integer")
    */
    protected $level;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPlan() {
        return $this->plan;
    }

    public function getLevel() {
        return $this->level;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPlan($plan) {
        $this->plan = $plan;
    }

    public function setLevel($level) {
        $this->level = $level;
    }
}
