<?php

class GoalController extends Zend_Controller_Action
{

    public function init()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
    }

    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();

		$goalMapper = new Application_Model_GoalMapper();
		$rows = $goalMapper->fetchAllByUserId($identity->id);

		$this->view->rows = $rows->toArray();
    }
    
    public function viewAction()
    {
    	$request = $this->getRequest();
		$id = $request->getParam('id');
		
    	$auth = Zend_Auth::getInstance();
    	$identity = $auth->getIdentity();
    	
    	if($id == NULL) {
    		$goalNamespace = new Zend_Session_Namespace('goal');
    		$this->view->goal = $goalNamespace->data;
    	} else {
    		$goalMapper = new Application_Model_GoalMapper();
    		$goal = new Application_Model_Goal();
    		
    		$goalMapper->find($id, $goal);    		
    		
    		$data = array(
				'id' 		=> $goal->getId(),
    			'goal'		=> $goal->getGoal(),
    			'notes' 	=> $goal->getNotes(),
    			'goal_date' => $goal->getGoalDate(),
    			'done'		=> $goal->getDone(),
    			'user_id'	=> $goal->getUserId()	
    		);
    		
    		$this->view->goal = $data;
    	}
    }
    
    public function addAction()
    {
    	$request = $this->getRequest();
    	$form = new Application_Form_Goal();
    	
    	if($request->isPost()) {
    		if($form->isValid($request->getPost())) {
    			$goalMapper = new Application_Model_GoalMapper();
    			$goal = new Application_Model_Goal($form->getValues());
    			
    			$auth = Zend_Auth::getInstance();
    			$identity = $auth->getIdentity();
    			
    			$goal->setUserId($identity->id);
    			
    			$id = $goalMapper->save($goal);
    			
    			$goal->setId($id);
    			
    			$goalNamespace = new Zend_Session_Namespace('goal');
    			
    			$data = array(
					'id' 		=> $goal->getId(),
					'goal'		=> $goal->getGoal(),
					'notes' 	=> $goal->getNotes(),
					'goal_date' => date_format(new DateTime($goal->getGoalDate()), 'Y-m-d'),
					'done'		=> $goal->getDone(),
					'user_id'	=> $goal->getUserId()
				);
    			
    			$goalNamespace->data = $data;
    			
    			$this->_redirect('/goal/view/');
    		}
    	}
    	
    	$this->view->form = $form;
    }

    public function editAction()
    {
    	$request = $this->getRequest();
    	$id = $request->getParam('id');
    	
    	if($id !== NULL) {
    		$form = new Application_Form_Goal();
    		$goalMapper = new Application_Model_GoalMapper();
    		
    		$auth = Zend_Auth::getInstance();
    		$identity = $auth->getIdentity();
    		
    		$goal = new Application_Model_Goal();    		
    		$goalMapper->find($id, $goal);
    		
    		$data = array(
    			'goal'		=> $goal->getGoal(),
    			'notes' 	=> $goal->getNotes(),
    			'goal_date' => date_format(new DateTime($goal->getGoalDate()), 'Y-m-d'),
    			'done'		=> $goal->getDone()
    		);
    		
    		$form->populate($data);   
    		
    		if($request->isPost()) {
    			if($form->isValid($request->getPost())) {
    				$goalMapper = new Application_Model_GoalMapper();
    				$goal = new Application_Model_Goal($form->getValues());
    				 
    				$auth = Zend_Auth::getInstance();
    				$identity = $auth->getIdentity();
    				
    				$goal->setId($id);
    				$goal->setUserId($identity->id);
    				$goal->setCreated(time());
    				 
    				$goalMapper->save($goal);
    				
    				$goalNamespace = new Zend_Session_Namespace('goal');
    				 
    				$data = array(
    					'id' 		=> $goal->getId(),
    					'goal'		=> $goal->getGoal(),
    					'notes' 	=> $goal->getNotes(),
    					'goal_date' => $goal->getGoalDate(),
    					'done'		=> $goal->getDone(),
    					'user_id'	=> $goal->getUserId()	
    				);
    				 
    				$goalNamespace->data = $data;
    				 
    				$this->_redirect('/goal/view/');
    			}
    		}
    		
    		$this->view->form = $form;
    	} else {
    		$this->_redirect('/dashboard');
    	}    	
    }
    
    public function deleteAction()
    {
    	$request = $this->getRequest();
    	$id = $request->getParam('id');
    	 
    	if($id !== NULL) {
    		
    		// @TODO Add confirmation before deleting permanently    		
    		$goalMapper = new Application_Model_GoalMapper();
    		$rowsDeleted = $goalMapper->delete($id);
    		
    		if($rowsDeleted == 1) {
    			$this->view->msg = 'Goal successfully deleted.';
    		} elseif($rowsDeleted <= 0) {
    			$this->view->msg = 'No goal with that id was found';
    		}
    	}
    }

}

