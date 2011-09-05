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

		$new = false;
		
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
		
		try {
			$profileMapper = new Application_Model_ProfileMapper();
			$profile = new Application_Model_Profile();

			$result = $profileMapper->find($identity->id, $profile);

			if($result == NULL){
				$new = true;
			}
		} catch(Exception $e){
			throw new Exception($e->getMessage());
		}
		
	
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$profile->setOptions($form->getValues());
				$profile->setUserId($identity->id);
				
				$profileMapper->save($profile, $new);
				
				// display success message
				$this->view->msg = "<p class='msg'>Profile saved</p>";
			}
		} else {
			 
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



