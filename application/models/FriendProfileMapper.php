<?php

class Application_Model_FriendProfileMapper
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
			$this->setDbTable('Application_Model_DbTable_FriendProfile');
		}
		return $this->_dbTable;
	}
	
	public function fetchRequests($user_id)
	{
		$table = $this->getDbTable();
	
		$select = $table->select()->where('confirmed = ?', 0)->where('profile_id <> ?', $user_id)->where('user_id = ?', $user_id)->orWhere('friend_user_id = ?', $user_id);
		// select profile first name last name
		$resultSet = $table->fetchAll($select);
	
		return $resultSet;
	}
	
	public function fetchAllByUserId($user_id)
	{
		$table = $this->getDbTable();
	
		$select = $table->select()->where('confirmed = ?', 1)->where('user_id = ?', $user_id)->where('profile_id <> ?', $user_id)->orWhere('friend_user_id = ?', $user_id)->where('profile_id <> ?', $user_id);
		
		$resultSet = $table->fetchAll($select);
	
		return $resultSet;
	}

}

