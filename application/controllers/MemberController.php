<?php

class MemberController extends Zend_Controller_Action
{

    public function init()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
        }		
    }

    public function indexAction()
    {
        $this->_redirect('member/find');
    }

    public function findAction()
    {
        // display a search field to enter a user's name
        // display an alphabetical list of users
        // @TODO implement pagination set limit per page set overal limit for results
        // @TODO implement list of alphabet to display all members whose name starts with that letter - see Packtpub.PHP.5.Social.Networking.Oct.2010
    	$request = $this->getRequest();
    	$form = new Application_Form_Member();
    	
    	if($request->isPost()) {
    		if($form->isValid($request->getPost())) {
    			$memberMapper = new Application_Model_MemberMapper();
		    	try {
		    		$auth = Zend_Auth::getInstance();
		    		$identity = $auth->getIdentity();
		    		
		    		$rows = $memberMapper->fetchAllByName($form->getValue('name'), $identity->id);
		    	} catch (Exception $e) {
		    		throw new Exception($e->getMessage());
		    	}
		    	
		    	$this->view->rows = $rows->toArray();
    		}
    	}
    	
    	$this->view->form = $form;
    }

    public function viewAction()
    {
        // action body
    }


}





