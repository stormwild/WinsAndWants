<?php

class Application_Form_Friend extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
		$this->setMethod('post');
		
		// Set the id of the form
		$this->setAttrib('id', 'friend');
		
		$this->addElementPrefixPath('Wins_Filter', 'Wins/Filter/', 'filter');
    }


}

