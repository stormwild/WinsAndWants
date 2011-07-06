<?php

class DashboardController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
	}

	public function indexAction()
	{
		// action body
	}


}

