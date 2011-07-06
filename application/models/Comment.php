<?php

class Application_Model_Comment
{
	protected $_id;
	protected $_share_id;
	protected $_share_wins_and_wants_id;
	protected $_share_wins_and_wants_user_id;
	protected $_shared_user_id;
	protected $_text;
	protected $_created;
	protected $_updated;

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
			throw new Exception('Invalid comment property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid comment property');
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

	public function setShareId($share_id)
	{
		$this->_share_id = $share_id;
	}

	public function getShareId()
	{
		return $this->_share_id;
	}

	public function setShareWinsAndWantsId($share_wins_and_wants_id)
	{
		$this->_share_wins_and_wants_id = $share_wins_and_wants_id;
	}

	public function getShareWinsAndWantsId()
	{
		return $this->_share_wins_and_wants_id;
	}

	public function setShareWinsAndWantsUserId($share_wins_and_wants_user_id)
	{
		$this->_share_wins_and_wants_user_id = $share_wins_and_wants_user_id;
	}

	public function getShareWinsAndWantsUserId()
	{
		return $this->_share_wins_and_wants_user_id;
	}

	public function setText($text)
	{
		$this->_text = $text;
	}

	public function getText()
	{
		return $this->_text;
	}

	public function setCreated($created)
	{
		$this->_created = $created;
	}

	public function getCreated()
	{
		return $this->_created;
	}

	public function setUpdated($updated)
	{
		$this->_updated = $updated;
	}

	public function getUpdated()
	{
		return $this->_updated;
	}
}

