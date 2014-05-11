<?php

/**
 * komentarze actions.
 *
 * @package    typerzy
 * @subpackage komentarze
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class komentarzeComponents extends sfComponents 
{
	public function executeOstatnie()
	{
		$c = new Criteria();
		$c -> setLimit(10);
		$c -> addDescendingOrderByColumn(KomentarzePeer::CREATED_AT);
		$this -> komentarze = KomentarzePeer::doSelect($c);
	}
	
	public function executeForm()
	{
		
	}
}
