<?php

class Application_Model_FriendMapper
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
			$this->setDbTable('Application_Model_DbTable_Friend');
		}
		return $this->_dbTable;
	}
	
	public function find($id, Application_Model_Friend $friend)
	{
		$result = $this->getDbTable()->find($id);
		if(0 === count($result)) {
			return;
		}
		$friend->setOptions($result->current()->toArray());
	}
	
	/**
	 * 
	 * Determines if the request exists
	 * @param int $user_id
	 * @param int $friend_user_id
	 * 
	 * returns true or false
	 */
	public function exists($user_id, $friend_user_id)
	{
		$table = $this->getDbTable();
		
		$select = $table->select()->where('user_id = ?', $user_id)->orWhere('friend_user_id = ?', $friend_user_id);
		
		$rowset = $table->fetchAll($select);
		
		$rowCount = count($rowset);
		
		if ($rowCount > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function fetchAllByUserId($user_id) 
	{
		$table = $this->getDbTable();
		
		$select = $table->select()->where('confirmed = ?', 1)->where('user_id = ?', $user_id)->orWhere('friend_user_id = ?', $user_id);

		$resultSet = $table->fetchAll($select);
		
		return $resultSet;
	}
	
	public function save(Application_Model_Friend $friend)
	{
		$data = array(
			'id' 			=> $friend->getId(),
			'user_id'		=> $friend->getUserId(),
			'friend_user_id'=> $friend->getFriendUserId(),
			'confirmed'		=> $friend->getConfirmed()		
		);
		
		if (null === ($id = $friend->getId())) {
			unset($data['id']);
			return $this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}
	
	public function fetchRequests($friend_user_id)
	{
		$table = $this->getDbTable();
		
		$select = $table->select()->where('user_id = ?', $friend_user_id)->orWhere('friend_user_id = ?', $friend_user_id)->where('confirmed = ?', 0);
		// select profile first name last name
		$resultSet = $table->fetchAll($select);
		
		return $resultSet;
	}

}

