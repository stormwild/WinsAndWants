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
    	$id = $request->getParam('id');
    	
    	$goalMapper = new Application_Model_GoalMapper();
        $goal = new Application_Model_Goal();
        
        $goalMapper->find($id, $goal);
        
        $this->view->goal = $goal; 
        
    }


}



