<?php

class Application_Model_GoalMapper
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
			$this->setDbTable('Application_Model_DbTable_Goal');
		}
		return $this->_dbTable;
	}
	
	public function find($id, Application_Model_Goal $goal)
	{
		$result = $this->getDbTable()->find($id);
		if(0 === count($result)) {
			return;
		}
		$goal->setOptions($result->current()->toArray());
	}
	
	public function save(Application_Model_Goal $goal)
	{
		$data = array(
			'id' 		=> $goal->getId(),
			'goal'		=> $goal->getGoal(),
			'notes' 	=> $goal->getNotes(),
			'goal_date' => $goal->getGoalDate(),
			'done'		=> $goal->getDone(),
			'user_id'	=> $goal->getUserId(),
			'created'	=> $goal->getCreated()		
		);
		
		if (null === ($id = $goal->getId())) {
			unset($data['id']);
			return $this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}
	
	public function fetchAllByUserId($user_id)
	{
	
		$table = $this->getDbTable();
	
		$select = $table->select()->where('user_id = ?', $user_id)->order('id DESC');
	
		$resultSet = $table->fetchAll($select);
	
		return $resultSet;
	}
	
	public function delete($id) 
	{
		$table = $this->getDbTable();
		
		/* $select = $table->select();
		
		$select->where('id = ?', $id); */
		
		$db = $table->getAdapter();
		
		$where = $db->quoteInto('id = ?', $id);

		//$rowsDeleted = $table->delete($select);

		$rowsDeleted = $table->delete($where);
		
		return $rowsDeleted; 
	}
}