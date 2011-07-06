<?php

class Application_Model_UserHasRoleMapper
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
			$this->setDbTable('Application_Model_DbTable_UserHasRole');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_UserHasRole $userHasRole)
	{
		$data = array(
			'user_id'		=> $userHasRole->getUserId(),
			'role_id'		=> $userHasRole->getRoleId()
		);
		return $this->getDbTable()->insert($data);

	}

	public function delete($user_id)
	{
		$where = $this->getDbTable()->getAdapter()->quoteInto('user_id = ?', $user_id);
		return $this->getDbTable()->delete($where);
	}
}

