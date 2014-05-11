<?php

/**
 * Subclass for representing a row from the 'typy_mecz' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Mecz extends BaseMecz
{
	public function __toString()
	{
		return $this->getDruzyny() . ' ' . $this->getWynik();
	}
	
	public function getDruzyny()
	{
		return $this->getZespol1() . '-' . $this->getZespol2();
	}
	
	public function getWynik()
	{
		if($this->getRozegrany())
		{
			return $this->getGole1() . ':' . $this->getGole2(); 
		}
		else
		{
			return "-:-";
		}
	}
	public function getAktywny()
	{
		# Pobranie infomracji czy do tej pory byl aktywny jesli tak 
		# sprawdzenie czy jest mozliwe typowanie na godzine przed meczem
		# jesli nie to ustawienie aktywny na false
		$aktywny = parent::getAktywny();
		if($aktywny)
		{
			$teraz  = time();
			if($this->getData('U') < ($teraz + 3600))
			{
				$this -> setAktywny(false);
				$this -> save();
				return false;
			}
			else
			{
				return true;
			}
		}
		return false;
	}

	public function setRozegrany($v)
	{
		
		if($v)
		{
			foreach($this -> getTyps() as $typ)
			{
				if($this -> getGole1().':'.$this->getGole2() == $typ -> getWynik())
				{
					$typ -> setPunkty(3);
				}
				elseif(($this->getGole1() > $this ->getGole2() && $typ -> getGole1() > $typ -> getGole2()) ||
						($this->getGole1() < $this ->getGole2() && $typ -> getGole1() < $typ -> getGole2()) ||
						($this->getGole1() == $this ->getGole2() && $typ -> getGole1() == $typ -> getGole2()) )
				{
					$typ -> setPunkty(1);
				}
				else
				{
					$typ -> setPunkty(0);
				}
				$typ -> save();
				
			}
		}
		parent::setRozegrany($v);
	}
	
	public function getTwojTyp()
	{
		$c = new Criteria();
		$c -> add(TypPeer::MECZ_ID,$this -> getId());
		$c -> add(TypPeer::USER_ID,sfContext::getInstance()->getUser()->getGuardUser()->getId());
		return TypPeer::doSelectOne($c);
	}
	
	public function getTypowany()
	{
		$c = new Criteria();
		$c -> add(TypPeer::MECZ_ID,$this->getId());
		$c -> add(TypPeer::USER_ID,sfContext::getInstance()->getUser()->getGuardUser()->getId());
		
		return TypPeer::doCount($c) ? true : false;
	}
}
