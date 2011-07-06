<?php

class Application_Model_DbTable_Share extends Zend_Db_Table_Abstract
{

    protected $_name = 'share';
    protected $_dependentTables = array('Comment');
    protected $_referenceMap = array (
		'WinsAndWants' => array(
			'columns' 		=> array('wins_and_wants_id'),
			'refTableClass'	=> 'WinsAndWants',
			'refColumns'	=> array('id')
		),
		'WinsAndWants' => array(
			'columns' 		=> array('wins_and_wants_user_id'),
			'refTableClass'	=> 'WinsAndWants',
			'refColumns'	=> array('user_id')
		)
	);


}

