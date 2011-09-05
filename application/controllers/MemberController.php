<?php

class MemberController extends Zend_Controller_Action
{

    public function init()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
    }

    public function indexAction()
    {
        $this->_redirect('member/find');
    }

    public function findAction()
    {
        // display a search field to enter a user's name
        // display an alphabetical list of users
        // pagination
    }


}



