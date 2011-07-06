<?php

class Application_Model_WinsAndWants
{
	protected $_id;

	protected $_created;

	protected $_wins_01;
	protected $_wins_02;
	protected $_wins_03;
	protected $_wins_04;
	protected $_wins_05;

	protected $_wants_01;
	protected $_wants_02;
	protected $_wants_03;
	protected $_wants_04;
	protected $_wants_05;

	protected $_wins_01_cb = false;
	protected $_wins_02_cb = false;
	protected $_wins_03_cb = false;
	protected $_wins_04_cb = false;
	protected $_wins_05_cb = false;

	protected $_wants_01_cb = false;
	protected $_wants_02_cb = false;
	protected $_wants_03_cb = false;
	protected $_wants_04_cb = false;
	protected $_wants_05_cb = false;

	protected $_emails;

	protected $_user_id;

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
			$key = str_replace("_", "", $key);
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
			throw new Exception('Invalid wins and wants property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid wins and wants property');
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

	public function setCreated($date)
	{
		$this->_created = $date;
	}

	public function getCreated()
	{
		return $this->_created;
	}

	public function setWins01($wins_01)
	{
		$this->_wins_01 = $wins_01;
	}

	public function getWins01()
	{
		return $this->_wins_01;
	}

	public function setWins02($wins_02)
	{
		$this->_wins_02 = $wins_02;
	}

	public function getWins02()
	{
		return $this->_wins_02;
	}

	public function setWins03($wins_03)
	{
		$this->_wins_03 = $wins_03;
	}

	public function getWins03()
	{
		return $this->_wins_03;
	}

	public function setWins04($wins_04)
	{
		$this->_wins_04 = $wins_04;
	}

	public function getWins04()
	{
		return $this->_wins_04;
	}

	public function setWins05($wins_05)
	{
		$this->_wins_05 = $wins_05;
	}

	public function getWins05()
	{
		return $this->_wins_05;
	}

	public function setWants01($wants_01)
	{
		$this->_wants_01 = $wants_01;
	}

	public function getWants01()
	{
		return $this->_wants_01;
	}

	public function setWants02($wants_02)
	{
		$this->_wants_02 = $wants_02;
	}

	public function getWants02()
	{
		return $this->_wants_02;
	}

	public function setWants03($wants_03)
	{
		$this->_wants_03 = $wants_03;
	}

	public function getWants03()
	{
		return $this->_wants_03;
	}

	public function setWants04($wants_04)
	{
		$this->_wants_04 = $wants_04;
	}

	public function getWants04()
	{
		return $this->_wants_04;
	}

	public function setWants05($wants_05)
	{
		$this->_wants_05 = $wants_05;
	}

	public function getWants05()
	{
		return $this->_wants_05;
	}

	public function setWins01cb($wins_01_cb)
	{
		$this->_wins_01_cb = $wins_01_cb;
	}

	public function getWins01cb()
	{
		return $this->_wins_01_cb;
	}

	public function setWins02cb($wins_02_cb)
	{
		$this->_wins_02_cb = $wins_02_cb;
	}

	public function getWins02cb()
	{
		return $this->_wins_02_cb;
	}

	public function setWins03cb($wins_03_cb)
	{
		$this->_wins_03_cb = $wins_03_cb;
	}

	public function getWins03cb()
	{
		return $this->_wins_03_cb;
	}

	public function setWins04cb($wins_04_cb)
	{
		$this->_wins_04_cb = $wins_04_cb;
	}

	public function getWins04cb()
	{
		return $this->_wins_04_cb;
	}

	public function setWins05cb($wins_05_cb)
	{
		$this->_wins_05_cb = $wins_05_cb;
	}

	public function getWins05cb()
	{
		return $this->_wins_05_cb;
	}

	public function setWants01cb($wants_01_cb)
	{
		$this->_wants_01_cb = $wants_01_cb;
	}

	public function getWants01cb()
	{
		return $this->_wants_01_cb;
	}

	public function setWants02cb($wants_02_cb)
	{
		$this->_wants_02_cb = $wants_02_cb;
	}

	public function getWants02cb()
	{
		return $this->_wants_02_cb;
	}

	public function setWants03cb($wants_03_cb)
	{
		$this->_wants_03_cb = $wants_03_cb;
	}

	public function getWants03cb()
	{
		return $this->_wants_03_cb;
	}

	public function setWants04cb($wants_04_cb)
	{
		$this->_wants_04_cb = $wants_04_cb;
	}

	public function getWants04cb()
	{
		return $this->_wants_04_cb;
	}

	public function setWants05cb($wants_05_cb)
	{
		$this->_wants_05_cb = $wants_05_cb;
	}

	public function getWants05cb()
	{
		return $this->_wants_05_cb;
	}

	public function setEmails($emails)
	{
		$this->_emails = $emails;
	}

	public function getEmails()
	{
		return $this->_emails;
	}

	public function setUserId($user_id)
	{
		$this->_user_id = $user_id;
	}

	public function getUserId()
	{
		return $this->_user_id;
	}
}

