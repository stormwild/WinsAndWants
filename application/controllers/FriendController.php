<?php

class FriendController extends Zend_Controller_Action
{

    public function init()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
    }

    public function indexAction()
    {
        // list friends of the current user
    	$auth = Zend_Auth::getInstance();
    	$identity = $auth->getIdentity();
    	
    	$friendMapper = new Application_Model_FriendMapper();
    	$rows = $friendMapper->fetchAllByUserId($identity->id);
    	
    	$this->view->rows = $rows->toArray();
    }

    public function findAction()
    {
        // find friends of the current user
    }

    public function addAction()
    {
        // add a member as a friend
        
    }


}





