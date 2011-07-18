<?php

class WinsAndWantsController extends Zend_Controller_Action
{

	/**
	 * Redirector - defined for code completion
	 *
	 * @var Zend_Controller_Action_Helper_Redirector
	 *
	 *
	 *
	 *
	 *
	 */
	protected $_redirector = null;

	public function init()
	{
		/* Initialize action controller here */
		// check if there is a logged in user
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}

		$this->_redirector = $this->_helper->getHelper('Redirector');
	}

	public function indexAction()
	{
		// action body
		$this->_redirect('winsandwants/view');
	}

	public function addAction()
	{
		// action body
		$request = $this->getRequest();
		$form = new Application_Form_WinsAndWants();

		if($request->isPost()) {
			if($form->isValid($request->getPost())) {

				$winsandwantsMapper = new Application_Model_WinsAndWantsMapper();
				$winsandwants = new Application_Model_WinsAndWants($form->getValues());

				$auth = Zend_Auth::getInstance();
				$identity = $auth->getIdentity();

				$winsandwants->setUserId($identity->id);

				if($form->save->isChecked()){
					$primaryKeys = $winsandwantsMapper->save($winsandwants);
					$winsandwants->setId($primaryKeys['id']);

					$wins = new Zend_Session_Namespace('wins');

					$data = array(
        	                	 'id' 		=> $winsandwants->getId(),

        	                	 'created'	=> $winsandwants->getCreated(),
        	                	 'wins_01'	=> $winsandwants->getWins01(),
        	                	 'wins_02'	=> $winsandwants->getWins02(),
        	                	 'wins_03'	=> $winsandwants->getWins03(),
        	                	 'wins_04'	=> $winsandwants->getWins04(),
        	                	 'wins_05'	=> $winsandwants->getWins05(),
        	                	 'wants_01'	=> $winsandwants->getWants01(),
        	                	 'wants_02'	=> $winsandwants->getWants02(),
        	                	 'wants_03'	=> $winsandwants->getWants03(),
        	                	 'wants_04'	=> $winsandwants->getWants04(),
        	                	 'wants_05'	=> $winsandwants->getWants05(),

        	                	 'emails'		=> $winsandwants->getEmails(),

        	                	 'user_id'	=> $winsandwants->getUserId()
					);
						
					$wins->data = $data;

					$this->_redirector->gotoUrl('/wins-and-wants/success/');

				} else if($form->share->isChecked()){
					$bootstrap = $this->getInvokeArg('bootstrap');
					$db = $bootstrap->getResource('db');

					// Start a transaction explicitly.
					$db->beginTransaction();
					try{
						$primaryKeys = $winsandwantsMapper->save($winsandwants);
						$winsandwants->setId($primaryKeys['id']);

						$wins = new Zend_Session_Namespace('wins');
						$wins->data = $winsandwants;

						$emails_str = str_replace(" ", "", $winsandwants->getEmails()); // strips whitespace from string
						$emails = explode(",", $emails_str); // splits string into an array using comma to split

						$validator = new Zend_Validate_EmailAddress();
						foreach ($emails as $email) {
							if(!$validator->isValid($email)){
								array_shift($emails); // Remove invalid emails
							}
						}

							

						// @todo create link to allow user to comment on the wins and wants
						// we need to provide the following information in the link,
						// the user_id, the winsandwants id, the shared winsandwants
						// we need to store this information in the database
						// then we need to retrieve it to display to the friend
						//
						// then we need to allow comments

						// @todo we can save objects to session: http://www.phpriot.com/articles/intro-php-sessions/8
						// also useful link on sessions http://stackoverflow.com/questions/132194/php-storing-objects-inside-the-session

						// since were sharing the winsandwants, we save this instance of a share to the database
						// @todo create the share vo and the share mapper

							
						$shareMapper = new Application_Model_ShareMapper();
						$share = new Application_Model_Share();

						$share->setWinsAndWantsId($winsandwants->getId());
						$share->setWinsAndWantsUserId($winsandwants->getUserId());

						$checked_wins = array();

						$checked_wins[] = $winsandwants->getWins01cb() ? '1' : null;
						$checked_wins[] = $winsandwants->getWins02cb() ? '2' : null;
						$checked_wins[] = $winsandwants->getWins03cb() ? '3' : null;
						$checked_wins[] = $winsandwants->getWins04cb() ? '4' : null;
						$checked_wins[] = $winsandwants->getWins05cb() ? '5' : null;

						$checked_wins = array_filter($checked_wins);

						$shared_wins = implode(',', $checked_wins);

						$share->setSharedWins($shared_wins);

						$checked_wants = array();

						$checked_wants[] =  $winsandwants->getWants01cb() ? '1' : null;
						$checked_wants[] =  $winsandwants->getWants02cb() ? '2' : null;
						$checked_wants[] =  $winsandwants->getWants03cb() ? '3' : null;
						$checked_wants[] =  $winsandwants->getWants04cb() ? '4' : null;
						$checked_wants[] =  $winsandwants->getWants05cb() ? '5' : null;

						$checked_wants = array_filter($checked_wants);

						$shared_wants = implode(',', $checked_wants);

						$share->setSharedWants($shared_wants);

						$sharePrimaryKeys = $shareMapper->save($share);
					}catch (Exception $e) {
						$db->rollBack();
						throw new Exception($e->getMessage(), $e->getCode());
					}

					$mail = new Zend_Mail();
					$mail->setFrom($identity->email, $identity->username);
					$mail->addTo($emails);
					$mail->setSubject('Sharing my winsandwants');

					$txt = 'http://winsandwants.com/wins-and-wants/share/id/' . $sharePrimaryKeys['id'];

					$mail->setBodyText($txt, 'UTF-8');
					$mail->send();

					$this->_redirector->gotoUrl('/wins-and-wants/success/');
				} elseif ($form->print->isChecked()){
					$wins = new Zend_Session_Namespace('wins');

					$wins->data = $winsandwants;
					$this->_redirector->gotoUrl('/wins-and-wants/print/');
				}

					
			}
		}

		$this->view->form = $form;
	}

	public function viewAction()
	{
		$request = $this->getRequest();

		$id = $request->getParam('id');

		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();

		$winsandwantsMapper = new Application_Model_WinsAndWantsMapper();
		$row = $winsandwantsMapper->fetchByIdAndUserId($id, $identity->id);

		$wins = new Zend_Session_Namespace('wins');

		$wins->data = $row;

		$this->view->wins = $row;
	}

	public function validateAction()
	{
		// action body
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();

		$form = new Application_Form_WinsAndWants();
		$form->isValid($this->_getAllParams());

		header('Content-type: application/json');
		echo Zend_Json::encode($form->getMessages());
	}

	public function successAction()
	{
		$wins = new Zend_Session_Namespace('wins');

		if(isset($wins->data)){
			$this->view->wins = $wins;
		} else {
			$this->_redirector->gotoUrl('/dashboard/');
		}
	}

	public function printAction()
	{
		$wins = new Zend_Session_Namespace('wins');

		if(isset($wins->data)){
			$this->view->wins = $wins->data;
		} else {
			$this->_redirector->gotoUrl('/dashboard/');
		}
		// enable going back to form
	}

	public function listAction()
	{
		// action body
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();

		$winsandwantsMapper = new Application_Model_WinsAndWantsMapper();
		$rows = $winsandwantsMapper->fetchAllByUserId($identity->id);

		$this->view->rows = $rows;
	}

	public function editAction()
	{
		// action body
		$request = $this->getRequest();
		$id = $request->getParam('id');

		if(isset($id)){

			$form = new Application_Form_WinsAndWants();
			$form->getElement('created')->removeValidator('Db_NoRecordExists');

			$winsandwantsMapper = new Application_Model_WinsAndWantsMapper();

			$auth = Zend_Auth::getInstance();
			$identity = $auth->getIdentity();

			$row = $winsandwantsMapper->fetchByIdAndUserId($id, $identity->id);

			$form->populate($row);

			if($request->isPost()) {
				if($form->isValid($request->getPost())) {

					$winsandwantsMapper = new Application_Model_WinsAndWantsMapper();
					$winsandwants = new Application_Model_WinsAndWants($form->getValues());

					$auth = Zend_Auth::getInstance();
					$identity = $auth->getIdentity();

					$winsandwants->setUserId($identity->id);

					$winsandwants->setId($id);

					/*
					 * The value of the submit buttons are retrieved through the request object parameters
					* since they do not exist in the $form object
					*/
					// Check which button was selected
					if($form->save->isChecked()){

						$winsandwantsMapper->save($winsandwants);

						$wins = new Zend_Session_Namespace('wins');

						$data = array(
        	            		 'id' 		=> $winsandwants->getId(),

        	                	 'created'	=> $winsandwants->getCreated(),
        	                	 'wins_01'	=> $winsandwants->getWins01(),
        	                	 'wins_02'	=> $winsandwants->getWins02(),
        	                	 'wins_03'	=> $winsandwants->getWins03(),
        	                	 'wins_04'	=> $winsandwants->getWins04(),
        	                	 'wins_05'	=> $winsandwants->getWins05(),
        	                	 'wants_01'	=> $winsandwants->getWants01(),
        	                	 'wants_02'	=> $winsandwants->getWants02(),
        	                	 'wants_03'	=> $winsandwants->getWants03(),
        	                	 'wants_04'	=> $winsandwants->getWants04(),
        	                	 'wants_05'	=> $winsandwants->getWants05(),

        	                	 'emails'		=> $winsandwants->getEmails(),

        	                	 'user_id'	=> $winsandwants->getUserId()
						);

						$wins->data = $data;

						$this->_redirector->gotoUrl('/wins-and-wants/success/');

					} elseif($form->share->isChecked()) {

						$winsandwantsMapper->save($winsandwants);

						$wins = new Zend_Session_Namespace('wins');

						$data = array(
        	                	 'id' 		=> $winsandwants->getId(),

        	                	 'created'	=> $winsandwants->getCreated(),
        	                	 'wins_01'	=> $winsandwants->getWins01(),
        	                	 'wins_02'	=> $winsandwants->getWins02(),
        	                	 'wins_03'	=> $winsandwants->getWins03(),
        	                	 'wins_04'	=> $winsandwants->getWins04(),
        	                	 'wins_05'	=> $winsandwants->getWins05(),
        	                	 'wants_01'	=> $winsandwants->getWants01(),
        	                	 'wants_02'	=> $winsandwants->getWants02(),
        	                	 'wants_03'	=> $winsandwants->getWants03(),
        	                	 'wants_04'	=> $winsandwants->getWants04(),
        	                	 'wants_05'	=> $winsandwants->getWants05(),

        	                	 'emails'		=> $winsandwants->getEmails(),

        	                	 'user_id'	=> $winsandwants->getUserId()
						);

						$wins->data = $data;

						$emails_str = str_replace(" ", "", $winsandwants->getEmails()); // strips whitespace from string
						$emails = explode(",", $emails_str); // splits string into an array using comma to split

						$validator = new Zend_Validate_EmailAddress();
						foreach ($emails as $email) {
							if(!$validator->isValid($email)){
								array_shift($emails); // Remove invalid emails
							}
						}

						$mail = new Zend_Mail();
						$mail->setFrom($identity->email, $identity->username);
						$mail->addTo($emails);
						$mail->setSubject('Sharing my winsandwants');

						try{
							$shareMapper = new Application_Model_ShareMapper();
							$share = new Application_Model_Share();

							$share->setWinsAndWantsId($winsandwants->getId());
							$share->setWinsAndWantsUserId($winsandwants->getUserId());

							$checked_wins = array();

							$checked_wins[] = $winsandwants->getWins01cb() ? '1' : null;
							$checked_wins[] = $winsandwants->getWins02cb() ? '2' : null;
							$checked_wins[] = $winsandwants->getWins03cb() ? '3' : null;
							$checked_wins[] = $winsandwants->getWins04cb() ? '4' : null;
							$checked_wins[] = $winsandwants->getWins05cb() ? '5' : null;

							$checked_wins = array_filter($checked_wins);

							$shared_wins = implode(',', $checked_wins);

							$share->setSharedWins($shared_wins);

							$checked_wants = array();

							$checked_wants[] =  $winsandwants->getWants01cb() ? '1' : null;
							$checked_wants[] =  $winsandwants->getWants02cb() ? '2' : null;
							$checked_wants[] =  $winsandwants->getWants03cb() ? '3' : null;
							$checked_wants[] =  $winsandwants->getWants04cb() ? '4' : null;
							$checked_wants[] =  $winsandwants->getWants05cb() ? '5' : null;

							$checked_wants = array_filter($checked_wants);

							$shared_wants = implode(',', $checked_wants);

							$share->setSharedWants($shared_wants);


							$sharePrimaryKeys = $shareMapper->save($share);
						}catch (Exception $e) {
							throw new Exception($e->getMessage(), $e->getCode());
						}

						$txt = 'http://winsandwants.com/wins-and-wants/share/id/' . $sharePrimaryKeys['id'];

						$mail->setBodyText($txt, 'UTF-8');
						$mail->send();

						$this->_redirector->gotoUrl('/wins-and-wants/success/');

					} elseif($form->print->isChecked()) {

						$wins = new Zend_Session_Namespace('wins');

						$data = array(
                        		 'Id' 		=> $winsandwants->getId(),

                        		 'Created'	=> $winsandwants->getCreated(),
                        		 'Wins 01'	=> $winsandwants->getWins01(),
                        		 'Wins 02'	=> $winsandwants->getWins02(),
                        		 'Wins 03'	=> $winsandwants->getWins03(),
                        		 'Wins 04'	=> $winsandwants->getWins04(),
                        		 'Wins 05'	=> $winsandwants->getWins05(),
                        		 'Wants 01'	=> $winsandwants->getWants01(),
                        		 'Wants 02'	=> $winsandwants->getWants02(),
                        		 'Wants 03'	=> $winsandwants->getWants03(),
                        		 'Wants 04'	=> $winsandwants->getWants04(),
                        		 'Wants 05'	=> $winsandwants->getWants05(),

                        		 'Emails'		=> $winsandwants->getEmails(),

                        		 'User Id'	=> $winsandwants->getUserId()
						);

						$wins->data = $data;
						$this->_redirector->gotoUrl('/wins-and-wants/print/');
					}
				}
			}

			$this->view->form = $form;
		} else {
			$this->_redirector->gotoUrl('/dashboard');
		}
	}

	public function shareAction()
	{
		// action body
		$request = $this->getRequest();
		$id = $request->getParam('id');

		if(isset($id)){
			$shareMapper = new Application_Model_ShareMapper();
			$rows = $shareMapper->find($id);

			// we need to extract the shared_wins and shared_wants if any
			// then we need to retrieve the wins_and_wants and specific wins and wants of
			// how do we do that?
			$this->view->rows = $rows[0];
		}
	}


}




/*if($primaryKeys != null){
 $winsandwants->setId($primaryKeys['id']);
}

$data = array(
'id' 		=> $winsandwants->getId(),

'created'	=> $winsandwants->getCreated(),
'wins_01'	=> $winsandwants->getWins01(),
'wins_02'	=> $winsandwants->getWins02(),
'wins_03'	=> $winsandwants->getWins03(),
'wins_04'	=> $winsandwants->getWins04(),
'wins_05'	=> $winsandwants->getWins05(),
'wants_01'	=> $winsandwants->getWants01(),
'wants_02'	=> $winsandwants->getWants02(),
'wants_03'	=> $winsandwants->getWants03(),
'wants_04'	=> $winsandwants->getWants04(),
'wants_05'	=> $winsandwants->getWants05(),

'wins_01_cb'	=> $winsandwants->getWins01cb(),
'wins_02_cb'	=> $winsandwants->getWins02cb(),
'wins_03_cb'	=> $winsandwants->getWins03cb(),
'wins_04_cb'	=> $winsandwants->getWins04cb(),
'wins_05_cb'	=> $winsandwants->getWins05cb(),
'wants_01_cb'	=> $winsandwants->getWants01cb(),
'wants_02_cb'	=> $winsandwants->getWants02cb(),
'wants_03_cb'	=> $winsandwants->getWants03cb(),
'wants_04_cb'	=> $winsandwants->getWants04cb(),
'wants_05_cb'	=> $winsandwants->getWants05cb(),
'emails'		=> $winsandwants->getEmails(),
'user_id'	=> $winsandwants->getUserId()
);*/



