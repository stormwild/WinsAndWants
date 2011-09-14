<?php

class Application_Model_ShareMapper
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
			$this->setDbTable('Application_Model_DbTable_Share'); 
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Share $share)
	{
		$data = array(
			'id' 				=> $share->getId(),
			'goal_id'			=> $share->getGoalId(),
			'user_id'			=> $share->getUserId(),
			'friend_user_id'	=> $share->getFriendUserId()	
		);
				
		if (null === ($id = $share->getId())) {
			unset($data['id']);
			return $this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}
	
	public function find($id)
	{
		return $this->getDbTable()->find($id);
	}

}

