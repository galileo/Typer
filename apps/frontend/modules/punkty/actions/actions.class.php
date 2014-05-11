<?php

/**
 * punkty actions.
 *
 * @package    typerzy
 * @subpackage punkty
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class punktyActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	$this->turniej = TurniejPeer::retrieveByPK(TurniejSettings::CURRENT_ID);
  	
  	$c = new Criteria();
  	$c -> add(PunktyPeer::TURNIEJ_ID, $this -> turniej -> getId());
  	$c -> addDescendingOrderByColumn(PunktyPeer::PUNKTY);
  	if($this->limit)
  	{
  		$c -> setLimit($this->limit);
  	}
  	
  	$this->punkty = PunktyPeer::doSelect($c);
  }
}
