<?php

class Application_Form_Member extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
		$this->setMethod('post');
		
		// Set the id of the form
		$this->setAttrib('id', 'member');
		
		$this->addElementPrefixPath('Wins_Filter', 'Wins/Filter/', 'filter');
		
		$this->addElement('text', 'name', array(
			'label' => 'Search by Name: ',
			'maxlength'  => 200,
		    'required' => true,
		    'filters'    => array('StringTrim', 'HTMLPurifier'),
		    'validators' => array(
				array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
				array('StringLength', false, 0, 200)
			)
		));
		
		// Set custom messages
		$this->getElement('name')->getValidator('NotEmpty')->setMessage('Name is required.');
		$this->getElement('name')->getValidator('StringLength')->setMessage('Name must be between 0-200 characters.');
		
		// Add the submit button
		$this->addElement('submit', 'search', array(
            'ignore'   => true,
			'label'    => 'Search'
		));
    }


}

