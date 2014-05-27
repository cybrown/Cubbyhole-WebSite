namespace Cubbyhole\WebApiBundle\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class User
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
* @Type("integer")
*/
protected $password;

/**
* @Type("integer")
* @SerializedName("planId")
*/
protected $plan_id;

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

public function getPlanId() {
return $this->planId;
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

public function setPlanId(planId) {
$this->planId = $plan_id;
}

public function setLevel($level) {
$this->level = $level;
}
