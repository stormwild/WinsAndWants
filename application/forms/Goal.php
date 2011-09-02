<?php

class Application_Form_Goal extends Zend_Form
{
	public function init()
	{
		// Set the method for the display form to POST
		$this->setMethod('post');
		
		// Set the id of the form
		$this->setAttrib('id', 'goal');
		
		$this->addElementPrefixPath('Wins_Filter', 'Wins/Filter/', 'filter');
		
		// add goal element
		$this->addElement('textarea', 'goal', array(
					'cols' 		 => 50,
					'rows'		 => 3,
					'maxlength'  => 140,
		            'label'      => 'Goal:',
		            'required'   => true,
		            'filters'    => array('StringTrim', 'HTMLPurifier'),
		        	'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('StringLength', false, 3, 140))
		));
		
		$this->getElement('goal')->getValidator('NotEmpty')->setMessage('Goal is required.');
		$this->getElement('goal')->getValidator('StringLength')->setMessage('Goal must be between 3-140 characters.');
		
		// notes element
		$this->addElement('textarea', 'notes', array(
							'cols' 		 => 50,
							'rows'		 => 6,
				        	'maxlength'  => 255,
				            'label'      => 'Notes:',
				            'required'   => false,
				            'filters'    => array('StringTrim', 'HTMLPurifier'),
				        	'validators' => array(
		array('StringLength', false, 0, 255))
		));
		
		$this->getElement('notes')->getValidator('StringLength')->setMessage('Notes must be between 0-255 characters.');
		
		// goal_date element
		$this->addElement('text', 'goal_date', array(
					'size'		 => 10,
		        	'maxlength'  => 10,
		            'label'      => 'Date: (yyyy-mm-dd)',
		            'required'   => true,
		            'filters'    => array('StringTrim'),
		        	'validators' => array(
		array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
		array('Date')
		)
		));
		// Set custom messages for goal_date
		$this->getElement('goal_date')->getValidator('NotEmpty')->setMessage('Date is required.');
		
		// done element
		$this->addElement('checkbox', 'done', array(
					'label'	=> 'Done:'
		));
		
		// Add the submit button
		$this->addElement('submit', 'save', array(
		            'ignore'   => true,
					'label'    => 'Save'
		));
	}
}