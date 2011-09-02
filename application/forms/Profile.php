<?php

class Application_Form_Profile extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
		$this->setMethod('post');
		
		// Set the id of the form
		$this->setAttrib('id', 'profile');
		
		$this->addElementPrefixPath('Wins_Filter', 'Wins/Filter/', 'filter');
		
		$this->addElement('text', 'first_name', array(
			'label' => 'First Name:',
		    'required' => true,
		    'filters'    => array('StringTrim', 'HTMLPurifier'),
		    'validators' => array(
				array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
				array('StringLength', false, 1, 100)
			)
		));
		
		$this->getElement('first_name')->getValidator('NotEmpty')->setMessage('First Name is required.');
		$this->getElement('first_name')->getValidator('StringLength')->setMessage('First Name must be between 1-100 characters.');
		
		$this->addElement('text', 'last_name', array(
					'label' => 'Last Name:',
				    'required' => true,
				    'filters'    => array('StringTrim', 'HTMLPurifier'),
				    'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('StringLength', false, 1, 100)
		)
		));
		
		$this->getElement('last_name')->getValidator('NotEmpty')->setMessage('Last Name is required.');
		$this->getElement('last_name')->getValidator('StringLength')->setMessage('Last Name must be between 1-100 characters.');

		// birthdate element
		$this->addElement('text', 'birthdate', array(
			'size'		 => 10,
			'maxlength'  => 10,
			'label'      => 'Birthdate: (yyyy-mm-dd)',
			'required'   => true,
			'filters'    => array('StringTrim'),
			'validators' => array(
				array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
				array('Date')
			)
		));
		// Set custom messages for birthdate
		$this->getElement('birthdate')->getValidator('NotEmpty')->setMessage('Date is required.');
		
		// gender element 
		$this->addElement('select', 'gender', array(
			'label'		=> 'Sex: (M/F)',
			'required' 	=> true,
			'filters'   => array('StringTrim'),
			'validators' => array(
				array('validator' => 'NotEmpty', 'breakChainOnFailure' => true)
			)
		));
		
		$this->getElement('gender')->getValidator('NotEmpty')->setMessage('Sex is required.');
		$options = array('M' => 'Male', 'F' => 'Female');
		$this->getElement('gender')->setMultiOptions($options);
		
		// submit button
		$this->addElement('submit', 'submit', array(
		            'ignore'   => true,
		            'label'    => 'Save',
		));
		
    }


}

