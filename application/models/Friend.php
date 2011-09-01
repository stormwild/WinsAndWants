<?php

class Application_Model_Friend
{
	protected $_id;
	protected $_user_id;
	protected $_friend_user_id;
	protected $_confirmed;
	
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
			
			if($pos !== false) {
				$key = substr_replace($key, array(strtoupper($key[$pos + 1]), strtoupper($key[$pos2 + 1])), array($pos + 1, $pos2 + 1), 1); // uppercase the character following the underscore
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

}

