<?php

class Application_Model_UserMapper
{
	protected $_dbTable;

	public function setDbTable($dbTable)
	{
		if(is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if(!$dbTable instanceof Zend_Db_Table_Abstract){
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable()
	{
		if(null === $this->_dbTable){
			$this->setDbTable('Application_Model_DbTable_User');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_User $user)
	{
		$password = sha1($user->getPassword());

		$data = array(
			'confirmed' => $user->getConfirmed(),
			'created'	=> $user->getCreated(),
			'email'		=> $user->getEmail(),
			'id'		=> $user->getId(),
			'name'		=> $user->getName(),
			'password'	=> $password 
		);

		if (null === ($id = $user->getId())) {
			unset($data['id']);
			return $this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}

	}

	public function confirm(array $params){

		// check if a user with the given params exist
		$table = $this->getDbTable();

		$select = $table->select();

		$select->where('id = ?', $params['id']);

		$row = $table->fetchRow($select);

		if(isset($row)){
			$data = array('confirmed' => 1);
			$this->getDbTable()->update($data, array('id = ?' => $params['id']));
		} else {
			throw new Exception('No match');
		}
	}

	public function find($id, Application_Model_User &$user)
	{
		$result = $this->getDbTable()->find($id);
		if(0 === count($result)) {
			return;
		}
		$user->setOptions((array)$result->current());
	}

	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$users = array();
		foreach($resultSet as $row){
			$user = new Application_Model_User((array)$row);
			$users[] = $user;
		}
		return $users;
	}

	public function fetchUserByEmail($email)
	{
		$table = $this->getDbTable();

		$select = $table->select();

		$select->where('email = ?', $email);

		$row = $table->fetchRow($select);

		if(isset($row)){
			$user = new Application_Model_User((array)$row->toArray());
			return $user;
		} else {
			throw new Exception('No match');
		}
	}

}

