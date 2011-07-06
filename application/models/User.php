<?php

class Application_Model_User
{
	protected $_confirmed = 0;
	protected $_created;
	protected $_email;
	protected $_id;
	protected $_name;
	protected $_password;

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

	public function setConfirmed($confirmed)
	{
		$this->_confirmed = $confirmed;
	}

	public function getConfirmed()
	{
		return $this->_confirmed;
	}

	public function setCreated($date)
	{
		$this->_created = $date;
	}

	public function getCreated()
	{
		if(null === $this->_created){
			return date('Y-m-d H:i:s'); // Y-m-d H:i:s
		} else {
			return $this->_created;
		}
	}

	public function setEmail($email)
	{
		$this->_email = $email;
	}

	public function getEmail()
	{
		return $this->_email;
	}

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setName($name)
	{
		$this->_name = $name;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function setPassword($password)
	{
		$this->_password = $password;
	}

	public function getPassword()
	{
		return $this->_password;
	}

}