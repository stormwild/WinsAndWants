<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
	}

	public function ceospeaksAction()
	{
		$request = $this->getRequest();
		 
		if($request->isPost()){
			
			// action body
			$emails_str = str_replace(" ", "", $request->getParam('emails')); // strips whitespace from string
			$emails = explode(",", $emails_str); // splits string into an array using comma to split

			$validator = new Zend_Validate_EmailAddress();
			foreach ($emails as $email) {
				if(!$validator->isValid($email)){
					array_shift($emails); // Remove invalid emails
				}
			}

			$mail = new Zend_Mail();
			$mail->setFrom('suggestions@winsandwants.com', 'winsandwants.com');
			$mail->setReplyTo('suggestions@winsandwants.com', 'winsandwants.com');
			$mail->addTo($emails);
			$mail->setSubject('Sharing winsandwants.com');

			$txt = "A friend would like to share with you this wonderful free site on goal-setting and the mastermind concept. Please visit: http://winsandwants.com";

			$mail->setBodyText($txt, 'UTF-8');
			$mail->send();
			
			$this->view->msg = "Thank you for sharing this site. A link to this site has been sent to the following emails: " . implode(",", $emails) . ".";
		} 
	}

	public function goalsettingAction()
	{
		// action body
	}

	public function winstemplateAction()
	{
		// action body
	}

	public function mastermindPrincipleAction()
	{
		// action body
	}

	public function useAction()
	{
		// action body
	}

	public function guidelinesAction()
	{
		// action body
	}

	public function purchaseAction()
	{
		// action body
	}

	public function privacyAction()
	{
		// action body
	}

	public function termsAction()
	{
		// action body
	}

	public function contactAction()
	{
		// action body
	}

	public function faqsAction()
	{
		// action body
	}

	public function donationsAction()
	{
		// action body
	}


}

























