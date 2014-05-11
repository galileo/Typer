<?php

/**
 * Subclass for representing a row from the 'typy_typ' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Typ extends BaseTyp
{
	public function __toString()
	{
		return $this->getWynik();
	}
	public function getWynik()
	{
		return $this->getGole1() . ':' . $this->getGole2();
	}
	public function isChangeAble()
	{
		if($this -> getMecz() -> getData('U') > time())
		{
			return true;
		}
		
		return false;
	}
	public function setPunkty($v)
	{
		parent::setPunkty($v);
		
		$c = new Criteria();
		$c -> add(PunktyPeer::TURNIEJ_ID,$this -> getMecz() -> getTurniej() -> getId());
		$c -> add(PunktyPeer::USER_ID, $this->getUserId());
		$punkty = PunktyPeer::doSelectOne($c);
		if($punkty)
		{
			$punkty -> setPunkty($punkty -> getPunkty() + $v);
		}
		else
		{
			$punkty = new Punkty();
			$punkty -> setPunkty($v);
			$punkty -> setUserId($this->getUserId());
			$punkty -> setTurniejId($this -> getMecz() -> getTurniej() -> getId());
		}
		$punkty -> save();
	}
	
	public function save($con = null)
	{
		
		if($this -> isNew())
		{
			$this->getMecz()->setTypyIlosc($this->getMecz()->getTypyIlosc() + 1 );
		}
		parent::save($con);
	}
}
