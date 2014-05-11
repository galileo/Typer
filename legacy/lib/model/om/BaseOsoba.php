<?php


abstract class BaseOsoba extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $login;


	
	protected $haslo;


	
	protected $mail;


	
	protected $aktywny;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collTyps;

	
	protected $lastTypCriteria = null;

	
	protected $collPunktys;

	
	protected $lastPunktyCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getLogin()
	{

		return $this->login;
	}

	
	public function getHaslo()
	{

		return $this->haslo;
	}

	
	public function getMail()
	{

		return $this->mail;
	}

	
	public function getAktywny()
	{

		return $this->aktywny;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OsobaPeer::ID;
		}

	} 
	
	public function setLogin($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->login !== $v) {
			$this->login = $v;
			$this->modifiedColumns[] = OsobaPeer::LOGIN;
		}

	} 
	
	public function setHaslo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->haslo !== $v) {
			$this->haslo = $v;
			$this->modifiedColumns[] = OsobaPeer::HASLO;
		}

	} 
	
	public function setMail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mail !== $v) {
			$this->mail = $v;
			$this->modifiedColumns[] = OsobaPeer::MAIL;
		}

	} 
	
	public function setAktywny($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->aktywny !== $v) {
			$this->aktywny = $v;
			$this->modifiedColumns[] = OsobaPeer::AKTYWNY;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = OsobaPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = OsobaPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->login = $rs->getString($startcol + 1);

			$this->haslo = $rs->getString($startcol + 2);

			$this->mail = $rs->getString($startcol + 3);

			$this->aktywny = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Osoba object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OsobaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OsobaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OsobaPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OsobaPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OsobaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OsobaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OsobaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collTyps !== null) {
				foreach($this->collTyps as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPunktys !== null) {
				foreach($this->collPunktys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = OsobaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTyps !== null) {
					foreach($this->collTyps as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPunktys !== null) {
					foreach($this->collPunktys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OsobaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getLogin();
				break;
			case 2:
				return $this->getHaslo();
				break;
			case 3:
				return $this->getMail();
				break;
			case 4:
				return $this->getAktywny();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OsobaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getLogin(),
			$keys[2] => $this->getHaslo(),
			$keys[3] => $this->getMail(),
			$keys[4] => $this->getAktywny(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OsobaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setLogin($value);
				break;
			case 2:
				$this->setHaslo($value);
				break;
			case 3:
				$this->setMail($value);
				break;
			case 4:
				$this->setAktywny($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OsobaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLogin($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setHaslo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAktywny($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OsobaPeer::DATABASE_NAME);

		if ($this->isColumnModified(OsobaPeer::ID)) $criteria->add(OsobaPeer::ID, $this->id);
		if ($this->isColumnModified(OsobaPeer::LOGIN)) $criteria->add(OsobaPeer::LOGIN, $this->login);
		if ($this->isColumnModified(OsobaPeer::HASLO)) $criteria->add(OsobaPeer::HASLO, $this->haslo);
		if ($this->isColumnModified(OsobaPeer::MAIL)) $criteria->add(OsobaPeer::MAIL, $this->mail);
		if ($this->isColumnModified(OsobaPeer::AKTYWNY)) $criteria->add(OsobaPeer::AKTYWNY, $this->aktywny);
		if ($this->isColumnModified(OsobaPeer::CREATED_AT)) $criteria->add(OsobaPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OsobaPeer::UPDATED_AT)) $criteria->add(OsobaPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OsobaPeer::DATABASE_NAME);

		$criteria->add(OsobaPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setLogin($this->login);

		$copyObj->setHaslo($this->haslo);

		$copyObj->setMail($this->mail);

		$copyObj->setAktywny($this->aktywny);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getTyps() as $relObj) {
				$copyObj->addTyp($relObj->copy($deepCopy));
			}

			foreach($this->getPunktys() as $relObj) {
				$copyObj->addPunkty($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new OsobaPeer();
		}
		return self::$peer;
	}

	
	public function initTyps()
	{
		if ($this->collTyps === null) {
			$this->collTyps = array();
		}
	}

	
	public function getTyps($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTypPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTyps === null) {
			if ($this->isNew()) {
			   $this->collTyps = array();
			} else {

				$criteria->add(TypPeer::OSOBA_ID, $this->getId());

				TypPeer::addSelectColumns($criteria);
				$this->collTyps = TypPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TypPeer::OSOBA_ID, $this->getId());

				TypPeer::addSelectColumns($criteria);
				if (!isset($this->lastTypCriteria) || !$this->lastTypCriteria->equals($criteria)) {
					$this->collTyps = TypPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTypCriteria = $criteria;
		return $this->collTyps;
	}

	
	public function countTyps($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTypPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TypPeer::OSOBA_ID, $this->getId());

		return TypPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTyp(Typ $l)
	{
		$this->collTyps[] = $l;
		$l->setOsoba($this);
	}


	
	public function getTypsJoinMecz($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTypPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTyps === null) {
			if ($this->isNew()) {
				$this->collTyps = array();
			} else {

				$criteria->add(TypPeer::OSOBA_ID, $this->getId());

				$this->collTyps = TypPeer::doSelectJoinMecz($criteria, $con);
			}
		} else {
									
			$criteria->add(TypPeer::OSOBA_ID, $this->getId());

			if (!isset($this->lastTypCriteria) || !$this->lastTypCriteria->equals($criteria)) {
				$this->collTyps = TypPeer::doSelectJoinMecz($criteria, $con);
			}
		}
		$this->lastTypCriteria = $criteria;

		return $this->collTyps;
	}

	
	public function initPunktys()
	{
		if ($this->collPunktys === null) {
			$this->collPunktys = array();
		}
	}

	
	public function getPunktys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePunktyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPunktys === null) {
			if ($this->isNew()) {
			   $this->collPunktys = array();
			} else {

				$criteria->add(PunktyPeer::OSOBA_ID, $this->getId());

				PunktyPeer::addSelectColumns($criteria);
				$this->collPunktys = PunktyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PunktyPeer::OSOBA_ID, $this->getId());

				PunktyPeer::addSelectColumns($criteria);
				if (!isset($this->lastPunktyCriteria) || !$this->lastPunktyCriteria->equals($criteria)) {
					$this->collPunktys = PunktyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPunktyCriteria = $criteria;
		return $this->collPunktys;
	}

	
	public function countPunktys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePunktyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PunktyPeer::OSOBA_ID, $this->getId());

		return PunktyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPunkty(Punkty $l)
	{
		$this->collPunktys[] = $l;
		$l->setOsoba($this);
	}


	
	public function getPunktysJoinTurniej($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePunktyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPunktys === null) {
			if ($this->isNew()) {
				$this->collPunktys = array();
			} else {

				$criteria->add(PunktyPeer::OSOBA_ID, $this->getId());

				$this->collPunktys = PunktyPeer::doSelectJoinTurniej($criteria, $con);
			}
		} else {
									
			$criteria->add(PunktyPeer::OSOBA_ID, $this->getId());

			if (!isset($this->lastPunktyCriteria) || !$this->lastPunktyCriteria->equals($criteria)) {
				$this->collPunktys = PunktyPeer::doSelectJoinTurniej($criteria, $con);
			}
		}
		$this->lastPunktyCriteria = $criteria;

		return $this->collPunktys;
	}

} 