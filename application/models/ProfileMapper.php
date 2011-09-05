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
		$resultSet = $this->getDbTable()->find($user_id);
		if(0 === count($resultSet)) {
			return;
		}
		$profile->setOptions($resultSet->current()->toArray());	
		return $resultSet->current();
	}
	
	public function save(Application_Model_Profile $profile, $new)
	{
		$data = array(
				'user_id'		=> $profile->getUserId(),
				'first_name' 	=> $profile->getFirstName(),
				'last_name' => $profile->getLastName(),
				'birthdate'		=> $profile->getBirthdate(),
				'gender'	=> $profile->getGender()	
		);
	
		if ($new) {
			return $this->getDbTable()->insert($data);
		} else {
			unset($data['user_id']);
			$this->getDbTable()->update($data, array('user_id = ?' => $profile->getUserId()));
		}
	}

}

