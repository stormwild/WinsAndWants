<?php

class Application_Model_WinsAndWantsMapper
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
			$this->setDbTable('Application_Model_DbTable_WinsAndWants');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_WinsAndWants $winsandwants)
	{
		$data = array(
			'id' 		=> $winsandwants->getId(),
			'created'	=> $winsandwants->getCreated(),
			'wins_01'	=> $winsandwants->getWins01(),
			'wins_02'	=> $winsandwants->getWins02(),
			'wins_03'	=> $winsandwants->getWins03(),
			'wins_04'	=> $winsandwants->getWins04(), 
			'wins_05'	=> $winsandwants->getWins05(),
			'wants_01'	=> $winsandwants->getWants01(),
			'wants_02'	=> $winsandwants->getWants02(),
			'wants_03'	=> $winsandwants->getWants03(),
			'wants_04'	=> $winsandwants->getWants04(), 
			'wants_05'	=> $winsandwants->getWants05(),
			'user_id'	=> $winsandwants->getUserId()
		);

		if (null === ($id = $winsandwants->getId())) {
			unset($data['id']);
			return $this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}

	public function fetchAll(){
		$resultSet = $this->getDbTable()->fetchAll();
		$winsandwants = array();
		foreach($resultSet as $row){
			$winsandwant = new Application_Model_WinsAndWants((array)$row);
			$winsandwants[] = $winsandwant;
		}
		return $winsandwants;
	}

	public function fetchAllByUserId($user_id){

		$table = $this->getDbTable();

		$select = $table->select()->where('user_id = ?', $user_id);

		$resultSet = $table->fetchAll($select);

		return $resultSet;
	}
	
	public function fetchByIdAndUserId($id, $user_id) {
		
		$table = $this->getDbTable();
		
		$select = $table->select()->where('user_id = ?', $user_id)->where('id = ?', $id);
		
		$row = $table->fetchRow($select);
		
		//$winsandwant = new Application_Model_WinsAndWants((array)$row->toArray());
		
		return $row->toArray();
		
	}
}

