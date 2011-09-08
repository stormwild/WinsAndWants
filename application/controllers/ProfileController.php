<?php

class ProfileController extends Zend_Controller_Action
{

	public function init()
	{
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
	}

	public function indexAction()
	{
		// display the profile form and populate if profile exists
		$request = $this->getRequest();
		$form = new Application_Form_Profile();

		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
		
		$profileMapper = new Application_Model_ProfileMapper();
		$profile = new Application_Model_Profile();

		$exists = $profileMapper->exists($identity->id); 
	
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$profile->setOptions($form->getValues());
				$profile->setUserId($identity->id);
				
				$profileMapper->save($profile, $exists);
				
				// display success message
				$this->view->msg = "<p class='msg'>Profile saved</p>";
			}
		} else {
			 
			$profileMapper->find($identity->id, $profile);
			
			$data = array(
	    		'first_name'	=> $profile->getFirstName(),
	    		'last_name'		=> $profile->getLastName(),
	    		'birthdate'		=> date_format(new DateTime($profile->getBirthdate()), 'Y-m-d'), 
	    		'gender'		=> $profile->getGender()
			);
			 
			$form->populate($data);
		}		 
		 
		$this->view->form = $form;
	}

}



