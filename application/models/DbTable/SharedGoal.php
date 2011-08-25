<?php

class Application_Model_DbTable_SharedGoal extends Zend_Db_Table_Abstract
{

    protected $_name = 'shared_goal';
    protected $_referenceMap = array (
		'Goal' => array(
			'columns' 		=> array('goal_id', 'user_id'),
			'refTableClass'	=> 'Goal',
			'refColumns'	=> array('id', 'user_id')
		),
		'User' => array(
			'columns' 		=> array('friend_user_id'),
			'refTableClass'	=> 'User',
			'refColumns'	=> array('id')
		)
	);


}

