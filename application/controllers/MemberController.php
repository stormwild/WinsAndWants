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
    	$request = $this->getRequest();
    	$form = new Application_Form_Member();
    	
    	if($request->isPost()) {
    		if($form->isValid($request->getPost())) {
    			$memberMapper = new Application_Model_MemberMapper();
		    	try {
		    		$rows = $memberMapper->fetchAllByName($form->getValue('name'));
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





