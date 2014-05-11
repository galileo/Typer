<?php

/**
 * mecze actions.
 *
 * @package    typerzy
 * @subpackage mecze
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class meczeComponents extends sfComponents 
{
	public function executeLista()
	{
		$this->turniej_id;
		$this->turniej = TurniejPeer::retrieveByPK($this->turniej_id);
	}
	
	public function executeRozegrane()
	{
		$time = strtotime(date('d-m-Y'));
		
	  	$this->turniej = TurniejPeer::retrieveByPK(TurniejSettings::CURRENT_ID);
	  	$c = new Criteria();
	  	$dateCriterion = $c->getNewCriterion(MeczPeer::DATA, $time, Criteria::LESS_THAN);
	  	
	  	$c->addAnd($dateCriterion);
	  	$c->addDescendingOrderByColumn(MeczPeer::DATA);
	  	
	  	$this->mecze = $this->turniej->getMeczs($c);
	}
	
	public function executeNext()
	{
		$time = strtotime(date('d-m-Y'));
		
		$this->turniej = TurniejPeer::retrieveByPK(TurniejSettings::CURRENT_ID);
		$c = new Criteria();
		$dateCriterion = $c->getNewCriterion(MeczPeer::DATA, $time, Criteria::GREATER_THAN);
	
		$c->addAnd($dateCriterion);
		$c->addAscendingOrderByColumn(MeczPeer::DATA);
		$c->setLimit(4);
	
		$this->mecze = $this->turniej->getMeczs($c);
	}
	
}
