<?php

class Application_Model_DbTable_WinsAndWants extends Zend_Db_Table_Abstract
{

	protected $_name = 'wins_and_wants';
	protected $_dependentTables = array('Share');
	protected $_referenceMap = array (
		'User' => array(
			'columns' 		=> array('user_id'),
			'refTableClass'	=> 'User',
			'refColumns'	=> array('id')
		)
	);

}

