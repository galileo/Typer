<?php

/**
 * user actions.
 *
 * @package    typerzy
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class userActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  
  public function executeSignin()
  {
  	if($this->getRequest()->getMethod() == sfRequest::POST)
  	{
  		$user = new sfGuardUser();
  		$user->setUsername($this->getRequestParameter('username'));
  		$user->setPassword($this->getRequestParameter('password'));
  		
  		$profile = new sfGuardUserProfile();
  		$profile -> setLastName($this->getRequestParameter('last_name'));
  		$profile -> setFirstName($this->getRequestParameter('first_name'));
  		$profile -> setEmail($this->getRequestParameter('email'));
  		$profile -> setsfGuardUser($user);
  		$profile->save();
  		$this->redirect('login');
  	}
  	$this->user = new sfGuardUser();
  }
  
  public function handleErrorSignin()
	{
	   
  		return sfView::SUCCESS;
	}
  
  public function executeProfile()
  {
  	$this->user = $this->getUser();
  }
  
  public function executeZasady()
  {
  	
  }
}
