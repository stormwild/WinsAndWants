<?php

class Application_Model_Share
{
	protected $_id;
	protected $_wins_and_wants_id;
	protected $_wins_and_wants_user_id;
	protected $_shared_wins;
	protected $_shared_wants;
	protected $_shared_user_id;

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
			throw new Exception('Invalid share property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid share property');
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

	public function setWinsAndWantsId($wins_and_wants_id)
	{
		$this->_wins_and_wants_id = $wins_and_wants_id;
	}

	public function getWinsAndWantsId()
	{
		return $this->_wins_and_wants_id;
	}

	public function setWinsAndWantsUserId($wins_and_wants_user_id)
	{
		$this->_wins_and_wants_user_id = $wins_and_wants_user_id;
	}

	public function getWinsAndWantsUserId()
	{
		return $this->_wins_and_wants_user_id;
	}

	public function setSharedWins($shared_wins)
	{
		$this->_shared_wins = $shared_wins;
	}

	public function getSharedWins()
	{
		return $this->_shared_wins;
	}

	public function setSharedWants($shared_wants)
	{
		$this->_shared_wants = $shared_wants;
	}

	public function getSharedWants()
	{
		return $this->_shared_wants;
	}

	public function setSharedUserId($shared_user_id)
	{
		$this->_shared_user_id = $shared_user_id;
	}

	public function getSharedUserId()
	{
		return $this->_shared_user_id;
	}
}

