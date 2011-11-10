<?php

class ShareController extends Zend_Controller_Action
{

	public function init()
	{
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
	}

	public function indexAction()
	{
		// display shared goals for logged in user
	}

	public function goalAction()
	{
		// get the params to get the goal
		// display the form to display the friends check box
		// create a form
		// process the form
		// insert multiple values / intelligent save checks for existing rows
		// let's take it one step at a time so that we make progress
		// create the link from the goal/view page

		$request = $this->getRequest();
		$goal_id = $request->getParam('id');
		 
		$form = new Application_Form_Share();

		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				// user id is from identity
				// goal id is from request param
				// friend_user_id is from form
				// friends[] contains array of friend_user_ids

				$auth = Zend_Auth::getInstance();
				$identity = $auth->getIdentity();
				
				$shareMapper = new Application_Model_ShareMapper();

				$shareList = array();
				
				$post = $form->getValues();
				
				foreach ($post['friends'] as $value)
				{
					$share = new Application_Model_Share();
					
					$share->setGoalId($goal_id);
					$share->setUserId($identity->id);
					$share->setFriendUserId($value);
					
					$shareList[] = $share;
				}
				
				var_dump($shareList);
				
				
				// we need to generate an array of $share objects based on the number of friend_user_ids passed through the form
				//$share = new Application_Model_Share();
				// we need to modify shareMapper->save to work with an array of share objects
				 
				//$post = $form->getValues();
				//var_dump($post['friends']); // array of user ids - working
				 
				//var_dump($post); // 
				
				//$shareMapper
				// we need to do this within the ShareMapper
				/*$tb = new Table;

				for ($i = 0; $i < 500; $i++) {
					$row = $tb->createRow();
					$row->blah = 'blah';
					$row->save();
				}*/
			}
		}
		 
		$goalMapper = new Application_Model_GoalMapper();
		$goal = new Application_Model_Goal();

		$goalMapper->find($goal_id, $goal);

		$data = array(
			'id' 		=> $goal->getId(),
            'goal'		=> $goal->getGoal(),
            'notes' 	=> $goal->getNotes(),
            'goal_date' => $goal->getGoalDate(),
            'done'		=> $goal->getDone(),
            'user_id'	=> $goal->getUserId()	
		);

		$this->view->goal = $data;

		$this->view->form = $form;

	}


}



