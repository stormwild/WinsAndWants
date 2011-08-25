<?php

class Application_Model_Goal
{
	protected $_id;
	protected $_goal;
	protected $_notes;
	protected $_goal_date;
	protected $_done;
	protected $_user_id;
	protected $_created;

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
			$pos = strpos($key, "_"); // get the index of the underscore
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

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setGoal($goal)
	{
		$this->_goal = $goal;
	}

	public function getGoal()
	{
		return $this->_goal;
	}
	
	public function setNotes($notes)
	{
		$this->_notes = $notes;
	}
	
	public function getNotes()
	{
		return $this->_notes;
	}
	
	public function setGoalDate($goal_date)
	{
		$this->_goal_date = $goal_date;
	}

	public function getGoalDate()
	{
		return $this->_goal_date;
	}
	
	public function setDone($done)
	{
		$this->_done = $done;
	}
	
	public function getDone()
	{
		return $this->_done;
	}
	
	public function setUserId($user_id)
	{
		$this->_user_id = $user_id;
	}
	
	public function getUserId()
	{
		return $this->_user_id;
	}
	
	public function setCreated($created)
	{
		$this->_created = $created;
	}
	
	public function getCreated()
	{
		return $this->_created;
	}
	

}

