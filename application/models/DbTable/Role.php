<?php

class Application_Model_DbTable_Role extends Zend_Db_Table_Abstract
{

	protected $_name = 'role';
	protected $_dependentTables = array('UserHasRoles');

}

