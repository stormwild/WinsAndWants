<?php

class Application_Model_Profile
{
	protected $_user_id;
	protected $_first_name;
	protected $_last_name;
	protected $_birthdate;
	protected $_gender;
	
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
			if($pos !== false) {
				$key = substr_replace($key, strtoupper($key[$pos + 1]), $pos + 1, 1); // uppercase the character following the underscore
				$key = str_replace("_", "", $key); // remove the underscore
			}
				
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
	
	public function setUserId($user_id)
	{
		$this->_user_id = $user_id;
	}
	
	public function getUserId()
	{
		return $this->_user_id;
	}
	
	public function setFirstName($first_name)
	{
		$this->_first_name = $first_name;
	}
	
	public function getFirstName()
	{
		return $this->_first_name;
	}

	public function setLastName($last_name)
	{
		$this->_last_name = $last_name;
	}
	
	public function getLastName()
	{
		return $this->_last_name;
	}
	
	public function setBirthdate($birthdate)
	{
		$this->_birthdate = $birthdate;
	}
	
	public function getBirthdate()
	{
		return $this->_birthdate;
	}
	
	public function setGender($gender)
	{
		$this->_gender = $gender;
	}
	
	public function getGender()
	{
		return $this->_gender;
	}
}

