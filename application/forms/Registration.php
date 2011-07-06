<?php

class Application_Form_Registration extends Zend_Form
{

	public function init()
	{
		/* Form Elements & Other Definitions Here ... */
		 
		// Set the method for the display form to POST
		$this->setMethod('post');

		// Set the id of the form
		$this->setAttrib('id', 'registration');

		// Add an username element
		$this->addElement('text', 'name', array(
        	'maxlength'  => 30,
            'label'      => 'Username:',
            'required'   => true,
            'filters'    => array('StringTrim', 'StringToLower'),
        	'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('StringLength', false, 3, 30),
		array('Db_NoRecordExists', false, array('table' => 'user', 'field' => 'name'))
		/*array('Regex', array('pattern' => '/^[a-z][a-z0-9_]/i'))*/
		)
		));

		// Set custom messages
		$this->getElement('name')->getValidator('NotEmpty')->setMessage('Username is required.');
		$this->getElement('name')->getValidator('Db_NoRecordExists')->setMessage('Username exists.');
		$this->getElement('name')->getValidator('StringLength')->setMessage('Username must be between 3-30 characters.');

		// Add a password element
		// @TODO create custom validator for password; use regex pattern to insure complex password
		$this->addElement('password', 'password', array(
            'label'      => 'Password:',
            'required'   => true,
            'filters'    => array('StringTrim'),
        	'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('StringLength', false, 6, 30)
		)
		));

		$this->getElement('password')->getValidator('NotEmpty')->setMessage('Password is required.');
		$this->getElement('password')->getValidator('StringLength')->setMessage('Password must be between 6-30 characters.');

		// Add a password element
		$this->addElement('password', 'confirm_password', array(
            'label'      => 'Confirm Password:',
            'required'   => true,
            'filters'    => array('StringTrim'),
        	'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('Identical', false, array('token' => 'password'))
		)
		));

		$this->getElement('confirm_password')->getValidator('NotEmpty')->setMessage('Confirm Password is required.');
		$this->getElement('confirm_password')->getValidator('Identical')->setMessage('Password and Confirm Password must match.');

		// Add an email element
		$this->addElement('text', 'email', array(
            'label'      => 'Your email address:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
                'EmailAddress',
		array('Db_NoRecordExists', false, array('table' => 'user', 'field' => 'email'))
		)
		));

		$this->getElement('email')->getValidator('NotEmpty')->setMessage('Email is required.');
		$this->getElement('email')->getValidator('Db_NoRecordExists')->setMessage('Email exists.');

		// Add the submit button
		$this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Register',
		));
	}


}

