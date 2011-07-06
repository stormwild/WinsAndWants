<?php

class Application_Model_DbTable_UserHasRole extends Zend_Db_Table_Abstract
{

	protected $_name = 'user_has_role';
	protected $_referenceMap = array (
		'User' => array(
			'columns' 		=> array('user_id'),
			'refTableClass'	=> 'User',
			'refColumns'	=> array('id')
		),
		'Role' => array(
			'columns' 		=> array('role_id'),
			'refTableClass'	=> 'Role',
			'refColumns'	=> array('id')
		)
	);
}

