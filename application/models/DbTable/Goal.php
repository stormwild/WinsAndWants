<?php

class Application_Model_DbTable_Goal extends Zend_Db_Table_Abstract
{

	protected $_name = 'goal';
	protected $_dependentTables = array('SharedGoal');
	protected $_referenceMap = array (
		'User' => array(
			'columns' 		=> array('user_id'),
			'refTableClass'	=> 'User',
			'refColumns'	=> array('id')
		)
	);

}

