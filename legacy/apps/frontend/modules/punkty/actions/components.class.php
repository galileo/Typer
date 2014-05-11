<?php
class punktyComponents extends sfComponents 
{
	public function executeTabela()
	{
		$this->turniej = TurniejPeer::retrieveByPK(TurniejSettings::CURRENT_ID);
		
		$c = new Criteria();
		$c -> add(PunktyPeer::TURNIEJ_ID, $this -> turniej -> getId());
		$c -> addDescendingOrderByColumn(PunktyPeer::PUNKTY);
		if($this->limit)
		{
			$c -> setLimit($this->limit);
		}
		
		$this -> punkty = PunktyPeer::doSelect($c);
		
	}
	
	public function executeFastTable()
	{
		$this->executeTabela();
	}
	
	public function executeHead()
	{
		$c = new Criteria();
		$this -> wszyscy = sfGuardUserProfilePeer::doCount($c);
		$c -> add(sfGuardUserProfilePeer::PIENIADZE, 0 , Criteria::GREATER_THAN);
		$this -> zaplacili = sfGuardUserProfilePeer::doCount($c);
		
	}
}
?>