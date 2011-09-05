<?php

class DashboardController extends Zend_Controller_Action
{

	public function init()
	{
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
	}

	public function indexAction()
	{
		// display links - see index.phtml
		
		// check to see if the user has a profile
		// if not display the profile form
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
		
		$profileMapper = new Application_Model_ProfileMapper();
		$profile = new Application_Model_Profile();
		
		$result = $profileMapper->find($identity->id, $profile);

		if($result == NULL) {
			$this->_redirect('profile');
			// @TODO save $result to session to allow profile to populate form
		} else {
			// get the first and last name and display on the dashboard
		}
		
	}


}

