<?php

class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{

    protected $_name = 'comment';
	protected $_referenceMap = array (
    	'User' => array(
			'columns' 		=> array('shared_user_id'),
			'refTableClass'	=> 'User',
			'refColumns'	=> array('id')
		),
		'Share' => array(
			'columns' 		=> array('share_id'),
			'refTableClass'	=> 'Share',
			'refColumns'	=> array('id')
		),
		'Share' => array(
			'columns' 		=> array('share_wins_and_wants_id'),
			'refTableClass'	=> 'Share',
			'refColumns'	=> array('wins_and_wants_id')
		),
		'Share' => array(
			'columns' 		=> array('share_wins_and_wants_user_id'),
			'refTableClass'	=> 'Share',
			'refColumns'	=> array('wins_and_wants_user_id')
		),
	);

}

