<?php

class Application_Form_Share extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
		$this->setMethod('post');
		
		// Set the id of the form
		$this->setAttrib('id', 'share');
		
		$this->addElementPrefixPath('Wins_Filter', 'Wins/Filter/', 'filter');

		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
		
		$friendProfileMapper = new Application_Model_FriendProfileMapper();
		$rows = $friendProfileMapper->fetchAllByUserId($identity->id);

		//var_dump($identity->id);
		
		$options = array();
		
		foreach ($rows as $row){
			$options[$row['user_id']] = $row['name'];
		}

		//var_dump($rows, $options);
				
		$this->addElement('multicheckbox', 'friends', array(
            'label'      => 'Friends:',
            'required'   => false,
			'filters'    => array('StringTrim'),
		    'validators' => array(
		    	array('InArray', false,	array(array_keys($options)))
		    ),
            'multioptions' => $options
		));
		
		// Add the submit button
		$this->addElement('submit', 'save', array(
			'ignore'   => true,
			'label'    => 'Share'
		));
		
    }


}

