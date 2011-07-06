<?php

class ServiceController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
    }

    public function indexAction()
    {
        // action body
    }

    public function validateAction()
    {
        // action body
        $form = new Application_Form_WinsAndWants();
		$form->isValid($this->_getAllParams());

		header('Content-type: application/json');
		echo Zend_Json::encode($form->getMessages());
    }


}



