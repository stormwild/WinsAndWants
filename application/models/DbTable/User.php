<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';
	protected $_dependentTables = array('UserHasRole', 'WinsAndWants', 'Share', 'Comment');

}

