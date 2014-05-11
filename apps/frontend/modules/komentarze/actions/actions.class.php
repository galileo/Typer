<?php

/**
 * komentarze actions.
 *
 * @package    typerzy
 * @subpackage komentarze
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class komentarzeActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  
  public function executeComment()
  {
  	$komentarz = new Komentarze();
  	
  	$komentarz -> setTytul(strip_tags($this-> getRequestParameter('tytul')));
  	$komentarz -> setTresc(strip_tags($this-> getRequestParameter('tresc')));
  	$komentarz -> setUserId($this -> getUser() -> getGuardUser() -> getId());
  	$komentarz -> save();
  	$this -> redirect($this -> getRequest() -> getReferer());
  }
}
