<?php

class Application_Form_Login extends Zend_Form
{

	public function init()
	{
		/* Form Elements & Other Definitions Here ... */
		$this->setMethod('post');
			
		$this->addElement('text', 'name', array(
            'label' => 'Username:',
            'required' => true,
            'filters'    => array('StringTrim'),
    		'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('validator' => 'Db_RecordExists', 'breakChainOnFailure' => true, 'options' => array('user', 'name')),
		array('StringLength', false, 3, 30)
		)
		));

		// Set custom messages
		$this->getElement('name')->getValidator('NotEmpty')->setMessage('Username is required.');
		$this->getElement('name')->getValidator('Db_RecordExists')->setMessage('Username does not exist.');
		$this->getElement('name')->getValidator('StringLength')->setMessage('Username must be between 3-30 characters.');

		$this->addElement('password', 'password', array(
            'label' => 'Password:',
            'required' => true,
        	'filters'    => array('StringTrim'),
    		'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('StringLength', false, 6, 30)
		)
		));

		$this->getElement('password')->getValidator('NotEmpty')->setMessage('Password is required.');
		$this->getElement('password')->getValidator('StringLength')->setMessage('Password must be between 6-30 characters.');

		$this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
		));
	}


}

