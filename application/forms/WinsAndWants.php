<?php

class Application_Form_WinsAndWants extends Zend_Form
{

	public function init()
	{
		/* Form Elements & Other Definitions Here ... */
			
		// Set the method for the display form to POST
		$this->setMethod('post');

		// Set the id of the form
		$this->setAttrib('id', 'winsandwants');
		
		// Set element decorators
		$this->setElementDecorators(array(
			array('ViewHelper'),
			array('Errors'),
			array('Label', array('requiredSuffix' => '*', 'class' => 'leftalign'))
		));

		// Set form decorators
		$this->setDecorators(array(
    		'FormElements',
			array('HtmlTag', array('tag' => '')),
    		'Form',
		));

		// Add an date element
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();

		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
				
		$clause = $dbAdapter->quoteInto('user_id = ?', $identity->id);
		
		$this->addElement('text', 'created', array(
			'size'		 => 10,
        	'maxlength'  => 10,
            'label'      => 'Date:',
            'required'   => true,
            'filters'    => array('StringTrim'),
        	'validators' => array(
				array('validator' => 'NotEmpty', 'breakChainOnFailure' => true),
				array('Date'),
				array('Db_NoRecordExists', false, array('table' => 'wins_and_wants', 'field' => 'created', 'exclude' => $clause))
			)
		));
		// Set custom messages for created
		$this->getElement('created')->getValidator('NotEmpty')->setMessage('Date is required.');
		$this->getElement('created')->getValidator('Db_NoRecordExists')->setMessage('You already have a winsandwants for this date.');

		// Add an wins01 element
		$this->addElement('text', 'wins_01', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wins 01:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wins_01')->getValidator('StringLength')->setMessage('Wins 01 must be between 0-140 characters.');
		// Add an wins01 checkbox element
		$this->addElement('checkbox', 'wins_01_cb');

		// Add an wins02 element
		$this->addElement('text', 'wins_02', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wins 02:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wins_02')->getValidator('StringLength')->setMessage('Wins 02 must be between 0-140 characters.');
		// Add an wins02 checkbox element
		$this->addElement('checkbox', 'wins_02_cb');

		// Add an wins03 element
		$this->addElement('text', 'wins_03', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wins 03:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wins_03')->getValidator('StringLength')->setMessage('Wins 03 must be between 0-140 characters.');
		// Add an wins03 checkbox element
		$this->addElement('checkbox', 'wins_03_cb');

		// Add an wins04 element
		$this->addElement('text', 'wins_04', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wins 04:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wins_04')->getValidator('StringLength')->setMessage('Wins 04 must be between 0-140 characters.');
		// Add an wins04 checkbox element
		$this->addElement('checkbox', 'wins_04_cb');

		// Add an wins05 element
		$this->addElement('text', 'wins_05', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wins 05:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wins_05')->getValidator('StringLength')->setMessage('Wins 05 must be between 0-140 characters.');
		// Add an wins05 checkbox element
		$this->addElement('checkbox', 'wins_05_cb');

		$this->addDisplayGroup(
			array('wins_01', 'wins_02', 'wins_03', 'wins_04', 'wins_05', 'wins_01_cb', 'wins_02_cb', 'wins_03_cb', 'wins_04_cb', 'wins_05_cb'),
			'wins'
		);
		
		// Add an wants01 element
		$this->addElement('text', 'wants_01', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wants 01:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wants_01')->getValidator('StringLength')->setMessage('Wants 01 must be between 0-140 characters.');
		// Add an wants01 checkbox element
		$this->addElement('checkbox', 'wants_01_cb');

		// Add an wants02 element
		$this->addElement('text', 'wants_02', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wants 02:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wants_02')->getValidator('StringLength')->setMessage('Wants 02 must be between 0-140 characters.');
		// Add an wants02 checkbox element
		$this->addElement('checkbox', 'wants_02_cb');

		// Add an wants03 element
		$this->addElement('text', 'wants_03', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wants 03:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wants_03')->getValidator('StringLength')->setMessage('Wants 03 must be between 0-140 characters.');
		// Add an wants03 checkbox element
		$this->addElement('checkbox', 'wants_03_cb');

		// Add an wants04 element
		$this->addElement('text', 'wants_04', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wants 04:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wants_04')->getValidator('StringLength')->setMessage('Wants 04 must be between 0-140 characters.');
		// Add an wants04 checkbox element
		$this->addElement('checkbox', 'wants_04_cb');

		// Add an wants05 element
		$this->addElement('text', 'wants_05', array(
			'size'		 => 60,
        	'maxlength'  => 140,
            'label'      => 'Wants 05:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
		array('StringLength', false, 0, 140)
		)
		));
		// Set custom messages
		$this->getElement('wants_05')->getValidator('StringLength')->setMessage('Wants 05 must be between 0-140 characters.');
		// Add an wants05 checkbox element
		$this->addElement('checkbox', 'wants_05_cb');

		$this->addDisplayGroup(
			array('wants_01', 'wants_02', 'wants_03', 'wants_04', 'wants_05', 'wants_01_cb', 'wants_02_cb', 'wants_03_cb', 'wants_04_cb', 'wants_05_cb'),
			'wants'
		);
		
		// Add an emails element
		$this->addElement('textarea', 'emails', array(
			'rows'		 => 2,
			'cols'		 => 65,
            'label'      => 'Share with:',
            'required'   => false,
            'filters'    => array('StringTrim', 'StripTags', 'HtmlEntities'),
        	'validators' => array(
				array('StringLength', false, 0, 400)
			)
		));
		// Set custom messages
		$this->getElement('emails')->getValidator('StringLength')->setMessage('Emails are limited 400 characters.');

		// Add the submit button
		$this->addElement('submit', 'save', array(
            'ignore'   => true,
			'label'    => 'Save Only'
		));

		$this->getElement('save')->removeDecorator('label')
		->removeDecorator('HtmlTag');		
				
		// Add the submit button
		$this->addElement('submit', 'share', array(
            'ignore'   => true,
            'label'    => 'Save & Share'
		));
		
		$this->getElement('share')->removeDecorator('label')
		->removeDecorator('HtmlTag');
		
		// Add the submit button
		$this->addElement('submit', 'print', array(
            'ignore'   => true,
            'label'    => 'Print'
		));

		$this->getElement('print')->removeDecorator('label')
		->removeDecorator('HtmlTag');
		
		
	}


}

