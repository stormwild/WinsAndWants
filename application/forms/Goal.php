<?php

class Application_Form_Goal extends Zend_Form
{
	public function init()
	{
		// Set the method for the display form to POST
		$this->setMethod('post');
		
		// Set the id of the form
		$this->setAttrib('id', 'goal');
		
		$this->addElement('text', 'goal', array(
		        	'maxlength'  => 140,
		            'label'      => 'Goal:',
		            'required'   => true,
		            'filters'    => array('StringTrim'),
		        	'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('StringLength', false, 3, 140))
		));
		
		$this->getElement('goal')->getValidator('NotEmpty')->setMessage('Goal is required.');
		$this->getElement('goal')->getValidator('StringLength')->setMessage('Goal must be between 3-140 characters.');
		
	}
}