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
		// action body
		// display the profile form and populate if profile exists
		$request = $this->getRequest();
		$form = new Application_Form_Profile();
		 
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
		
		$profileMapper = new Application_Model_ProfileMapper();
		$profile = new Application_Model_Profile();
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$profile->setOptions($form->getValues());
				$profileMapper->save($profile);

				// display success message
				$this->view->msg = "Profile saved";
			}
		} else {
			 
			$profileMapper->find($identity->id, $profile);
			 
			$data = array(
    		'first_name'	=> $profile->getFirstName(),
    		'last_name'		=> $profile->getLastName(),
    		'birthdate'		=> $profile->getBirthdate(),
    		'gender'		=> $profile->getGender()
			);
			 
			$form->populate($data);
		}
		 
		 
		$this->view->form = $form;
	}

}



