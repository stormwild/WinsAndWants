<?php

class FriendController extends Zend_Controller_Action
{

    public function init()
    {
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('auth/login');
		}
    }

    public function indexAction()
    {
		// list friends of the current user
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
			
		/* $friendMapper = new Application_Model_FriendMapper();
		$rows = $friendMapper->fetchAllByUserId($identity->id); */
			
		$friendProfileMapper = new Application_Model_FriendProfileMapper();
		$rows = $friendProfileMapper->fetchAllByUserId($identity->id);
			
		$this->view->rows = $rows->toArray();
    }

    public function findAction()
    {
		// find friends of the current user
    }

    public function addAction()
    {
		// add a member as a friend
		// given the logged in user and the id of the user to be added
		// add this to the friend database
		$request = $this->getRequest();
			
		if($request->isGet()){
			$friend_user_id = $request->getParam('id');

			if($friend_user_id != NULL) {
				$auth = Zend_Auth::getInstance();
				$identity = $auth->getIdentity();

				$friendMapper = new Application_Model_FriendMapper();
				$friend = new Application_Model_Friend();

				$friend->setUserId($identity->id);
				$friend->setFriendUserId($friend_user_id);

				// we need to check if the friend request is already existing before adding it to the db
				$exists = $friendMapper->exists($friend->getUserId(), $friend->getFriendUserId());

				if(!$exists) {
					try {
						$id = $friendMapper->save($friend);
						$this->view->msg = 'Your friend request has been sent.';
					} catch (Exception $e) {
						// @TODO Log exception
						$this->view->msg = $e->getMessage();
					}
				} else {
					// request was already sent
					$this->view->msg = 'Your friend request has already been sent.';
				}
					
			}

		}
    }

    public function requestAction()
    {
		// action body
		// display a list of pending friend requests
		// user may either confirm or ignore
		// list friends of the current user
		// use friendProfile
		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
			
		$friendProfileMapper = new Application_Model_FriendProfileMapper();
		$rows = $friendProfileMapper->fetchRequests($identity->id);
			
		$this->view->rows = $rows->toArray();
    }

    public function confirmAction()
    {
		$request = $this->getRequest();
		$id = $request->getParam('id');
		$user_id = $request->getParam('user_id');
		$friend_user_id = $request->getParam('friend_user_id'); 
		
		$friendMapper = new Application_Model_FriendMapper();
		$friend = new Application_Model_Friend();
		
		$friend->setId($id);
		$friend->setUserId($user_id);
		$friend->setFriendUserId($friend_user_id);
		$friend->setConfirmed(1);
		
		try {
			$friendMapper->save($friend);
			$this->view->msg = 'Friend successfully confirmed';
		} catch (Exception $e) {
			throw new Exception($e->getMessage(), $e->getFile(), $e->getPrevious());
		}
		
    }

    public function deleteAction()
    {
    	$request = $this->getRequest();
    	$id = $request->getParam('id');
    	 
    	if($id !== NULL) {
    		
    		// @TODO Add confirmation before deleting permanently    		
    		$friendMapper = new Application_Model_FriendMapper();
    		$rowsDeleted = $friendMapper->delete($id);
    		
    		if($rowsDeleted == 1) {
    			$this->view->msg = 'Friend removed successfully.';
    		} elseif($rowsDeleted <= 0) {
    			$this->view->msg = 'Friend was not removed.';
    		}
    	}
    }


}






