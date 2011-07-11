<?php

class Application_Form_Recover extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        
        $this->addElement('text', 'email', array(
            'label'      => 'Your email address:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
                'EmailAddress',
		array('Db_RecordExists', false, array('table' => 'user', 'field' => 'email'))
		)
		));

		$this->getElement('email')->getValidator('NotEmpty')->setMessage('Email is required.');
		$this->getElement('email')->getValidator('Db_RecordExists')->setMessage('Email does not exist.');

		// Add the submit button
		$this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Reset Password',
		));
    }


}

