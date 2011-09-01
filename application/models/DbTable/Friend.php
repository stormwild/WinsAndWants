<?php

class Application_Model_DbTable_Friend extends Zend_Db_Table_Abstract
{

    protected $_name = 'friend';
    protected $_referenceMap = array (
    	'User' => array(
    		'columns' 		=> array('user_id', 'friend_user_id'),
    		'refTableClass'	=> 'User',
    		'refColumns'	=> array('id')
    	)
    );

}

