<?php

class Application_Model_ProfileMapper
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
			$this->setDbTable('Application_Model_DbTable_Profile');
		}
		return $this->_dbTable;
	}
	
	public function find($user_id, Application_Model_Profile $profile)
	{
		$row = $this->getDbTable()->find($user_id);
		if(0 === count($row)) {
			return;
		}
		$profile->setOptions($row->toArray());		
	}
	
	public function save(Application_Model_Profile $profile)
	{
		$data = array(
				'user_id'		=> $profile->getUserId(),
				'first_name' 	=> $profile->getFirstName(),
				'last_name' => $profile->getLastName(),
				'birthdate'		=> $profile->getBirthdate(),
				'gender'	=> $profile->getGender()	
		);
	
		if (null === ($user_id = $profile->getUserId())) {
			unset($data['user_id']);
			return $this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('user_id = ?' => $user_id));
		}
	}

}

