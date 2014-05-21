<?php

/**
 * Base class that represents a row from the 'typy_mecz' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseMecz extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MeczPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the turniej_id field.
	 * @var        int
	 */
	protected $turniej_id;


	/**
	 * The value for the zespol1 field.
	 * @var        string
	 */
	protected $zespol1;


	/**
	 * The value for the zespol2 field.
	 * @var        string
	 */
	protected $zespol2;


	/**
	 * The value for the gole1 field.
	 * @var        int
	 */
	protected $gole1;


	/**
	 * The value for the gole2 field.
	 * @var        int
	 */
	protected $gole2;


	/**
	 * The value for the data field.
	 * @var        int
	 */
	protected $data;


	/**
	 * The value for the aktywny field.
	 * @var        boolean
	 */
	protected $aktywny;


	/**
	 * The value for the rozegrany field.
	 * @var        boolean
	 */
	protected $rozegrany;


	/**
	 * The value for the status field.
	 * @var        int
	 */
	protected $status;


	/**
	 * The value for the typy_ilosc field.
	 * @var        int
	 */
	protected $typy_ilosc;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the updated_at field.
	 * @var        int
	 */
	protected $updated_at;

	/**
	 * @var        Turniej
	 */
	protected $aTurniej;

	/**
	 * Collection to store aggregation of collTyps.
	 * @var        array
	 */
	protected $collTyps;

	/**
	 * The criteria used to select the current contents of collTyps.
	 * @var        Criteria
	 */
	protected $lastTypCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [turniej_id] column value.
	 * 
	 * @return     int
	 */
	public function getTurniejId()
	{

		return $this->turniej_id;
	}

	/**
	 * Get the [zespol1] column value.
	 * 
	 * @return     string
	 */
	public function getZespol1()
	{

		return $this->zespol1;
	}

	/**
	 * Get the [zespol2] column value.
	 * 
	 * @return     string
	 */
	public function getZespol2()
	{

		return $this->zespol2;
	}

	/**
	 * Get the [gole1] column value.
	 * 
	 * @return     int
	 */
	public function getGole1()
	{

		return $this->gole1;
	}

	/**
	 * Get the [gole2] column value.
	 * 
	 * @return     int
	 */
	public function getGole2()
	{

		return $this->gole2;
	}

	/**
	 * Get the [optionally formatted] [data] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getData($format = 'Y-m-d H:i:s')
	{

		if ($this->data === null || $this->data === '') {
			return null;
		} elseif (!is_int($this->data)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->data);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [data] as date/time value: " . var_export($this->data, true));
			}
		} else {
			$ts = $this->data;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [aktywny] column value.
	 * 
	 * @return     boolean
	 */
	public function getAktywny()
	{

		return $this->aktywny;
	}

	/**
	 * Get the [rozegrany] column value.
	 * 
	 * @return     boolean
	 */
	public function getRozegrany()
	{

		return $this->rozegrany;
	}

	/**
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{

		return $this->status;
	}

	/**
	 * Get the [typy_ilosc] column value.
	 * 
	 * @return     int
	 */
	public function getTypyIlosc()
	{

		return $this->typy_ilosc;
	}

	/**
	 * Get the [optionally formatted] [created_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
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

	/**
	 * Get the [optionally formatted] [updated_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
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

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MeczPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [turniej_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTurniejId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->turniej_id !== $v) {
			$this->turniej_id = $v;
			$this->modifiedColumns[] = MeczPeer::TURNIEJ_ID;
		}

		if ($this->aTurniej !== null && $this->aTurniej->getId() !== $v) {
			$this->aTurniej = null;
		}

	} // setTurniejId()

	/**
	 * Set the value of [zespol1] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setZespol1($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->zespol1 !== $v) {
			$this->zespol1 = $v;
			$this->modifiedColumns[] = MeczPeer::ZESPOL1;
		}

	} // setZespol1()

	/**
	 * Set the value of [zespol2] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setZespol2($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->zespol2 !== $v) {
			$this->zespol2 = $v;
			$this->modifiedColumns[] = MeczPeer::ZESPOL2;
		}

	} // setZespol2()

	/**
	 * Set the value of [gole1] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setGole1($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gole1 !== $v) {
			$this->gole1 = $v;
			$this->modifiedColumns[] = MeczPeer::GOLE1;
		}

	} // setGole1()

	/**
	 * Set the value of [gole2] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setGole2($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gole2 !== $v) {
			$this->gole2 = $v;
			$this->modifiedColumns[] = MeczPeer::GOLE2;
		}

	} // setGole2()

	/**
	 * Set the value of [data] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setData($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [data] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->data !== $ts) {
			$this->data = $ts;
			$this->modifiedColumns[] = MeczPeer::DATA;
		}

	} // setData()

	/**
	 * Set the value of [aktywny] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setAktywny($v)
	{

		if ($this->aktywny !== $v) {
			$this->aktywny = $v;
			$this->modifiedColumns[] = MeczPeer::AKTYWNY;
		}

	} // setAktywny()

	/**
	 * Set the value of [rozegrany] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setRozegrany($v)
	{

		if ($this->rozegrany !== $v) {
			$this->rozegrany = $v;
			$this->modifiedColumns[] = MeczPeer::ROZEGRANY;
		}

	} // setRozegrany()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStatus($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = MeczPeer::STATUS;
		}

	} // setStatus()

	/**
	 * Set the value of [typy_ilosc] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTypyIlosc($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->typy_ilosc !== $v) {
			$this->typy_ilosc = $v;
			$this->modifiedColumns[] = MeczPeer::TYPY_ILOSC;
		}

	} // setTypyIlosc()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = MeczPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = MeczPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->turniej_id = $rs->getInt($startcol + 1);

			$this->zespol1 = $rs->getString($startcol + 2);

			$this->zespol2 = $rs->getString($startcol + 3);

			$this->gole1 = $rs->getInt($startcol + 4);

			$this->gole2 = $rs->getInt($startcol + 5);

			$this->data = $rs->getTimestamp($startcol + 6, null);

			$this->aktywny = $rs->getBoolean($startcol + 7);

			$this->rozegrany = $rs->getBoolean($startcol + 8);

			$this->status = $rs->getInt($startcol + 9);

			$this->typy_ilosc = $rs->getInt($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = MeczPeer::NUM_COLUMNS - MeczPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Mecz object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MeczPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MeczPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(MeczPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(MeczPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MeczPeer::DATABASE_NAME);
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

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aTurniej !== null) {
				if ($this->aTurniej->isModified()) {
					$affectedRows += $this->aTurniej->save($con);
				}
				$this->setTurniej($this->aTurniej);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MeczPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += MeczPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collTyps !== null) {
				foreach($this->collTyps as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
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

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aTurniej !== null) {
				if (!$this->aTurniej->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTurniej->getValidationFailures());
				}
			}


			if (($retval = MeczPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTyps !== null) {
					foreach($this->collTyps as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MeczPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTurniejId();
				break;
			case 2:
				return $this->getZespol1();
				break;
			case 3:
				return $this->getZespol2();
				break;
			case 4:
				return $this->getGole1();
				break;
			case 5:
				return $this->getGole2();
				break;
			case 6:
				return $this->getData();
				break;
			case 7:
				return $this->getAktywny();
				break;
			case 8:
				return $this->getRozegrany();
				break;
			case 9:
				return $this->getStatus();
				break;
			case 10:
				return $this->getTypyIlosc();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MeczPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTurniejId(),
			$keys[2] => $this->getZespol1(),
			$keys[3] => $this->getZespol2(),
			$keys[4] => $this->getGole1(),
			$keys[5] => $this->getGole2(),
			$keys[6] => $this->getData(),
			$keys[7] => $this->getAktywny(),
			$keys[8] => $this->getRozegrany(),
			$keys[9] => $this->getStatus(),
			$keys[10] => $this->getTypyIlosc(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MeczPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTurniejId($value);
				break;
			case 2:
				$this->setZespol1($value);
				break;
			case 3:
				$this->setZespol2($value);
				break;
			case 4:
				$this->setGole1($value);
				break;
			case 5:
				$this->setGole2($value);
				break;
			case 6:
				$this->setData($value);
				break;
			case 7:
				$this->setAktywny($value);
				break;
			case 8:
				$this->setRozegrany($value);
				break;
			case 9:
				$this->setStatus($value);
				break;
			case 10:
				$this->setTypyIlosc($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MeczPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTurniejId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setZespol1($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setZespol2($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGole1($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setGole2($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setData($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAktywny($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRozegrany($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTypyIlosc($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MeczPeer::DATABASE_NAME);

		if ($this->isColumnModified(MeczPeer::ID)) $criteria->add(MeczPeer::ID, $this->id);
		if ($this->isColumnModified(MeczPeer::TURNIEJ_ID)) $criteria->add(MeczPeer::TURNIEJ_ID, $this->turniej_id);
		if ($this->isColumnModified(MeczPeer::ZESPOL1)) $criteria->add(MeczPeer::ZESPOL1, $this->zespol1);
		if ($this->isColumnModified(MeczPeer::ZESPOL2)) $criteria->add(MeczPeer::ZESPOL2, $this->zespol2);
		if ($this->isColumnModified(MeczPeer::GOLE1)) $criteria->add(MeczPeer::GOLE1, $this->gole1);
		if ($this->isColumnModified(MeczPeer::GOLE2)) $criteria->add(MeczPeer::GOLE2, $this->gole2);
		if ($this->isColumnModified(MeczPeer::DATA)) $criteria->add(MeczPeer::DATA, $this->data);
		if ($this->isColumnModified(MeczPeer::AKTYWNY)) $criteria->add(MeczPeer::AKTYWNY, $this->aktywny);
		if ($this->isColumnModified(MeczPeer::ROZEGRANY)) $criteria->add(MeczPeer::ROZEGRANY, $this->rozegrany);
		if ($this->isColumnModified(MeczPeer::STATUS)) $criteria->add(MeczPeer::STATUS, $this->status);
		if ($this->isColumnModified(MeczPeer::TYPY_ILOSC)) $criteria->add(MeczPeer::TYPY_ILOSC, $this->typy_ilosc);
		if ($this->isColumnModified(MeczPeer::CREATED_AT)) $criteria->add(MeczPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MeczPeer::UPDATED_AT)) $criteria->add(MeczPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MeczPeer::DATABASE_NAME);

		$criteria->add(MeczPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Mecz (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTurniejId($this->turniej_id);

		$copyObj->setZespol1($this->zespol1);

		$copyObj->setZespol2($this->zespol2);

		$copyObj->setGole1($this->gole1);

		$copyObj->setGole2($this->gole2);

		$copyObj->setData($this->data);

		$copyObj->setAktywny($this->aktywny);

		$copyObj->setRozegrany($this->rozegrany);

		$copyObj->setStatus($this->status);

		$copyObj->setTypyIlosc($this->typy_ilosc);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getTyps() as $relObj) {
				$copyObj->addTyp($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Mecz Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     MeczPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MeczPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Turniej object.
	 *
	 * @param      Turniej $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTurniej($v)
	{


		if ($v === null) {
			$this->setTurniejId(NULL);
		} else {
			$this->setTurniejId($v->getId());
		}


		$this->aTurniej = $v;
	}


	/**
	 * Get the associated Turniej object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Turniej The associated Turniej object.
	 * @throws     PropelException
	 */
	public function getTurniej($con = null)
	{
		if ($this->aTurniej === null && ($this->turniej_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseTurniejPeer.php';

			$this->aTurniej = TurniejPeer::retrieveByPK($this->turniej_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TurniejPeer::retrieveByPK($this->turniej_id, $con);
			   $obj->addTurniejs($this);
			 */
		}
		return $this->aTurniej;
	}

	/**
	 * Temporary storage of collTyps to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTyps()
	{
		if ($this->collTyps === null) {
			$this->collTyps = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mecz has previously
	 * been saved, it will retrieve related Typs from storage.
	 * If this Mecz is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTyps($criteria = null, $con = null)
	{
		// include the Peer class
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

				$criteria->add(TypPeer::MECZ_ID, $this->getId());

				TypPeer::addSelectColumns($criteria);
				$this->collTyps = TypPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TypPeer::MECZ_ID, $this->getId());

				TypPeer::addSelectColumns($criteria);
				if (!isset($this->lastTypCriteria) || !$this->lastTypCriteria->equals($criteria)) {
					$this->collTyps = TypPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTypCriteria = $criteria;
		return $this->collTyps;
	}

	/**
	 * Returns the number of related Typs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countTyps($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTypPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TypPeer::MECZ_ID, $this->getId());

		return TypPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Typ object to this object
	 * through the Typ foreign key attribute
	 *
	 * @param      Typ $l Typ
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTyp(Typ $l)
	{
		$this->collTyps[] = $l;
		$l->setMecz($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mecz is new, it will return
	 * an empty collection; or if this Mecz has previously
	 * been saved, it will retrieve related Typs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mecz.
	 */
	public function getTypsJoinsfGuardUser($criteria = null, $con = null)
	{
		// include the Peer class
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

				$criteria->add(TypPeer::MECZ_ID, $this->getId());

				$this->collTyps = TypPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TypPeer::MECZ_ID, $this->getId());

			if (!isset($this->lastTypCriteria) || !$this->lastTypCriteria->equals($criteria)) {
				$this->collTyps = TypPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastTypCriteria = $criteria;

		return $this->collTyps;
	}

} // BaseMecz
