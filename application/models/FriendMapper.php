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
	
	public function fetchAllByUserId($user_id) 
	{
		$table = $this->getDbTable();
		
		$select = $table->select()->where('user_id = ? and confirmed = 1', $user_id);
		
		$resultSet = $table->fetchAll($select);
		
		return $resultSet;
	}

}

