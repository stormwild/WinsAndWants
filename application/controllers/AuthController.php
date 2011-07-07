<?php

class AuthController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
		$this->_redirect('auth/register');
	}

	public function registerAction()
	{
		// action body
		$request = $this->getRequest();
		$form = new Application_Form_Registration();

		if($request->isPost()) {
			if($form->isValid($request->getPost())) {

				$userMapper = new Application_Model_UserMapper();
				$user = new Application_Model_User($form->getValues());
				$id = $userMapper->save($user);

				$user->setId($id);

				try {
					$this->sendConfirmationEmail($user);
				} catch (Exception $e) {
					// Do nothing if it fails while developing locally because we don't have a local smtp
					// Log error on production
					// @TODO
				}

				$form = null;
				$request->clearParams();

				$this->view->msg = 'An email with a confirmation link has been sent to your email. Please use the link to complete your registration.';
			}
		}

		$this->view->form = $form;
	}

	public function loginAction()
	{
		// action body
		$request = $this->getRequest();
		$form = new Application_Form_Login();

		if($request->isPost()) {
			if($form->isValid($request->getPost())) {

				$bootstrap = $this->getInvokeArg('bootstrap');
				$dbAdapter = $bootstrap->getResource('db');
				$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter, 'user', 'name', 'password');

				$data = $form->getValidValues($request->getPost());

				$authAdapter->setIdentity($data['name']);
				$password = sha1($data['password']);
				$authAdapter->setCredential($password);

				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);

				if($result->isValid()){

					$user = $authAdapter->getResultRowObject(null, 'password');
					$storage = $auth->getStorage();
					$storage->write($user);
					
					if($user->confirmed == 1) {
						$this->_redirect('dashboard'); // Redirect to dashboard
					} else {
						Zend_Auth::getInstance()->clearIdentity();
						$this->view->errors = array('You\'re registration is not yet confirmed');
					}

				} else {
					$form->getElement('password')->addError('Invalid password.');
				}

			}
		}

		$this->view->form = $form;
	}

	public function logoutAction()
	{
		// action body
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
	}

	public function confirmAction()
	{
		// action body
		define("MEMBER", 2);

		$request = $this->getRequest();

		$bootstrap = $this->getInvokeArg('bootstrap');
		$db = $bootstrap->getResource('db');

		// Start a transaction explicitly.
		$db->beginTransaction();

		try {
			// Update the User
			$userMapper = new Application_Model_UserMapper();
			$userMapper->confirm($request->getParams());

			// Add the UserHasRole
			// By default a user has a member role
			$userHasRoleMapper = new Application_Model_UserHasRoleMapper();
			$userHasRole = new Application_Model_UserHasRole();

			$userHasRole->setUserId($request->getParam('id'));
			$userHasRole->setRoleId(MEMBER); // @TODO 2 is the role id of member; should be a constant?

			$userHasRoleMapper->save($userHasRole);
			$db->commit();

			$url = $this->view->url(array('action' => 'login', 'controller' => 'auth'));
			
			// Display success message
			$this->view->msg = "Your registration is complete. You may now <a href='$url'>login</a>. ";
			
		} catch (Exception $e) {
			$db->rollBack();
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}
	
	public function recoverAction()
	{
		
	}

	private function sendConfirmationEmail(Application_Model_User &$user)
	{
		$mail = new Zend_Mail();
		$mail->setFrom('noreply@winsandwants.com', 'Wins and Wants');
		$mail->addTo($user->getEmail());
		$mail->setSubject('Registration Confirmation');
		$txt = <<<EOT
        Thank you for joining Wins and Wants.
        
        Please go to the link below to complete your registration:
        
EOT;

		$txt .= $this->getValidationLink($user); 
		
		$mail->setBodyText($txt, 'UTF-8');
		$mail->send();

	}
	
	private function getValidationLink(Application_Model_User $user)
	{
		if(getenv('APPLICATION_ENV') == 'development') {
			return 'http://localhost' . $this->view->baseUrl() . '/auth/confirm/id/' . $user->getId();
		} else {
			return 'http://winsandwants.com' . $this->view->baseUrl() . '/auth/confirm/id/' . $user->getId();
		}
	}
}









