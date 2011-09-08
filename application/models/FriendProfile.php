<?php

class Application_Model_FriendProfile
{
	protected $_id;
	protected $_user_id;
	protected $_friend_user_id;
	protected $_confirmed;
	protected $_profile_id;
	protected $_name;
	protected $_gender;
	protected $_age;
	
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$pos = strpos($key, "_"); // get the index of the first underscore
			$pos2 = strpost($key, "_", $pos + 1); // get the index of the 2nd underscore
				
			if($pos !== false && $pos2 !== false) {
				$key = substr_replace($key, array(strtoupper($key[$pos + 1]), strtoupper($key[$pos2 + 1])), array($pos + 1, $pos2 + 1), 1); // uppercase the character following the underscore
			} else {
				$key = substr_replace($key, strtoupper($key[$pos + 1]), $pos + 1, 1); // uppercase the character following the underscore
			}
	
			$key = str_replace("_", "", $key); // remove the underscore
				
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid user property');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid user property');
		}
		return $this->$method();
	}
	
	public function setId($id)
	{
		$this->_id = $id;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setUserId($user_id)
	{
		$this->_user_id = $user_id;
	}
	
	public function getUserId()
	{
		return $this->_user_id;
	}
	
	public function setFriendUserId($friend_user_id)
	{
		$this->_friend_user_id = $friend_user_id;
	}
	
	public function getFriendUserId()
	{
		return $this->_friend_user_id;
	}
	
	public function setConfirmed($confirmed)
	{
		$this->_confirmed = $confirmed;
	}
	
	public function getConfirmed()
	{
		return $this->_confirmed;
	}
	
	public function setProfileId($profile_id)
	{
		$this->_profile_id = $profile_id;
	}
	
	public function getProfileId()
	{
		return $this->_profile_id;
	}
	
	public function setName($name)
	{
		$this->_name = $name;
	}
	
	public function getName()
	{
		return $this->_name;
	}
	
	public function setGender($gender)
	{
		$this->_gender = $gender;
	}
	
	public function getGender()
	{
		return $this->_gender;
	}
	
	public function setAge($age)
	{
		$this->_age = $age;
	}
	
	public function getAge()
	{
		return $this->_age;
	}

}

