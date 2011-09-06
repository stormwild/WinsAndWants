<?php

class Application_Model_MemberMapper
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
			$this->setDbTable('Application_Model_DbTable_Member');
		}
		return $this->_dbTable;
	}
	
	public function find($id, Application_Model_Member $member)
	{
		$result = $this->getDbTable()->find($id);
		if(0 === count($result)) {
			return;
		}
		$member->setOptions($result->current()->toArray());
	}
	
	public function fetchAllByName($name)
	{
		$table = $this->getDbTable();
		
		$select = $table->select()->where('name LIKE ?', '%' . $name . '%');
		
		$resultSet = $table->fetchAll($select);
		
		return $resultSet;
	}
	
}

