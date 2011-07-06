<?php

class Application_Model_UserHasRole
{
	protected $_user_id;
	protected $_role_id;

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

	public function setUserId($user_id)
	{
		$this->_user_id = $user_id;
	}

	public function getUserId()
	{
		return $this->_user_id;
	}

	public function setRoleId($role_id)
	{
		$this->_role_id = $role_id;
	}

	public function getRoleId()
	{
		return $this->_role_id;
	}


}

