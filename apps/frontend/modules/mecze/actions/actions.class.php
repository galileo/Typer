<?php

/**
 * mecze actions.
 *
 * @package    typerzy
 * @subpackage mecze
 * @author     GalileoPrime
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class meczeActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  public function executeDzisiaj()
  {
  	
  }
  
  public function executeWszystkie()
  {
  	$this->turniej = TurniejPeer::retrieveByPK(2);
  	$c = new Criteria();
  	$c->addAscendingOrderByColumn(MeczPeer::DATA);
  	$this->mecze = $this->turniej -> getMeczs($c);
  }
  public function executeTypyLista()
  {
  	$this -> mecz = MeczPeer::retrieveByPK($this->getRequestParameter('mecz'));
  }
  
  public function executeGrupaA()
  {
  }
  
  public function executeGrupaB()
  {
  }
  
  public function executeGrupaC()
  {
  }
  
  public function executeGrupaD()
  {
  }
  
  public function executeGrupaE()
  {
  }
  
  public function executeGrupaF()
  {
  }
  
  public function executeGrupaG()
  {
  }
  
  public function executeGrupaH()
  {
  }
}
