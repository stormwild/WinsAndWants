<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initViewSettings(){
		$this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
        $view->headTitle('Wins and Wants');       

        /**
         * To obtain a valid baseUrl set an instance of the request object to the frontController
         * Reference: http://zend-framework-community.634137.n4.nabble.com/Autodetected-baseUrl-not-available-in-bootstrap-td1568601.html
         */
        $this->bootstrap('frontController');
		$front = $this->getResource('frontController');		
		$request = new Zend_Controller_Request_Http();		
		$front->setRequest($request); 
		
        $view->headLink()->prependStylesheet($view->baseUrl('css/HTML5_twoColFixRtHdr.css'));
        $view->headScript()->prependFile('http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js');
        
	}

}

