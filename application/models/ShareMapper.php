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
			'id' 		=> $share->getId(),
			'wins_and_wants_id'	=> $share->getWinsAndWantsId(),
			'wins_and_wants_user_id'	=> $share->getWinsAndWantsUserId(),
			'shared_wins'	=> $share->getSharedWins(),
			'shared_wants'	=> $share->getSharedWants(),
			'shared_user_id'	=> $share->getSharedUserId()
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

