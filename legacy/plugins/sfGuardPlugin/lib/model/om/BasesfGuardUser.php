<?php

/**
 * Base class that represents a row from the 'sf_guard_user' table.
 *
 * 
 *
 * @package    plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardUser extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        sfGuardUserPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the username field.
	 * @var        string
	 */
	protected $username;


	/**
	 * The value for the algorithm field.
	 * @var        string
	 */
	protected $algorithm = 'sha1';


	/**
	 * The value for the salt field.
	 * @var        string
	 */
	protected $salt;


	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the last_login field.
	 * @var        int
	 */
	protected $last_login;


	/**
	 * The value for the is_active field.
	 * @var        boolean
	 */
	protected $is_active = true;


	/**
	 * The value for the is_super_admin field.
	 * @var        boolean
	 */
	protected $is_super_admin = false;

	/**
	 * Collection to store aggregation of collsfGuardUserPermissions.
	 * @var        array
	 */
	protected $collsfGuardUserPermissions;

	/**
	 * The criteria used to select the current contents of collsfGuardUserPermissions.
	 * @var        Criteria
	 */
	protected $lastsfGuardUserPermissionCriteria = null;

	/**
	 * Collection to store aggregation of collsfGuardUserGroups.
	 * @var        array
	 */
	protected $collsfGuardUserGroups;

	/**
	 * The criteria used to select the current contents of collsfGuardUserGroups.
	 * @var        Criteria
	 */
	protected $lastsfGuardUserGroupCriteria = null;

	/**
	 * Collection to store aggregation of collsfGuardRememberKeys.
	 * @var        array
	 */
	protected $collsfGuardRememberKeys;

	/**
	 * The criteria used to select the current contents of collsfGuardRememberKeys.
	 * @var        Criteria
	 */
	protected $lastsfGuardRememberKeyCriteria = null;

	/**
	 * Collection to store aggregation of collKomentarzes.
	 * @var        array
	 */
	protected $collKomentarzes;

	/**
	 * The criteria used to select the current contents of collKomentarzes.
	 * @var        Criteria
	 */
	protected $lastKomentarzeCriteria = null;

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
	 * Collection to store aggregation of collPunktys.
	 * @var        array
	 */
	protected $collPunktys;

	/**
	 * The criteria used to select the current contents of collPunktys.
	 * @var        Criteria
	 */
	protected $lastPunktyCriteria = null;

	/**
	 * Collection to store aggregation of collsfGuardUserProfiles.
	 * @var        array
	 */
	protected $collsfGuardUserProfiles;

	/**
	 * The criteria used to select the current contents of collsfGuardUserProfiles.
	 * @var        Criteria
	 */
	protected $lastsfGuardUserProfileCriteria = null;

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
	 * Get the [username] column value.
	 * 
	 * @return     string
	 */
	public function getUsername()
	{

		return $this->username;
	}

	/**
	 * Get the [algorithm] column value.
	 * 
	 * @return     string
	 */
	public function getAlgorithm()
	{

		return $this->algorithm;
	}

	/**
	 * Get the [salt] column value.
	 * 
	 * @return     string
	 */
	public function getSalt()
	{

		return $this->salt;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{

		return $this->password;
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
	 * Get the [optionally formatted] [last_login] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getLastLogin($format = 'Y-m-d H:i:s')
	{

		if ($this->last_login === null || $this->last_login === '') {
			return null;
		} elseif (!is_int($this->last_login)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->last_login);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [last_login] as date/time value: " . var_export($this->last_login, true));
			}
		} else {
			$ts = $this->last_login;
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
	 * Get the [is_active] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsActive()
	{

		return $this->is_active;
	}

	/**
	 * Get the [is_super_admin] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSuperAdmin()
	{

		return $this->is_super_admin;
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
			$this->modifiedColumns[] = sfGuardUserPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [username] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsername($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::USERNAME;
		}

	} // setUsername()

	/**
	 * Set the value of [algorithm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setAlgorithm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->algorithm !== $v || $v === 'sha1') {
			$this->algorithm = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ALGORITHM;
		}

	} // setAlgorithm()

	/**
	 * Set the value of [salt] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSalt($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::SALT;
		}

	} // setSalt()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPassword($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::PASSWORD;
		}

	} // setPassword()

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
			$this->modifiedColumns[] = sfGuardUserPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [last_login] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setLastLogin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [last_login] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_login !== $ts) {
			$this->last_login = $ts;
			$this->modifiedColumns[] = sfGuardUserPeer::LAST_LOGIN;
		}

	} // setLastLogin()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_ACTIVE;
		}

	} // setIsActive()

	/**
	 * Set the value of [is_super_admin] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsSuperAdmin($v)
	{

		if ($this->is_super_admin !== $v || $v === false) {
			$this->is_super_admin = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_SUPER_ADMIN;
		}

	} // setIsSuperAdmin()

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

			$this->username = $rs->getString($startcol + 1);

			$this->algorithm = $rs->getString($startcol + 2);

			$this->salt = $rs->getString($startcol + 3);

			$this->password = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->last_login = $rs->getTimestamp($startcol + 6, null);

			$this->is_active = $rs->getBoolean($startcol + 7);

			$this->is_super_admin = $rs->getBoolean($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUser object", $e);
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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfGuardUserPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(sfGuardUserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collsfGuardUserPermissions !== null) {
				foreach($this->collsfGuardUserPermissions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardUserGroups !== null) {
				foreach($this->collsfGuardUserGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardRememberKeys !== null) {
				foreach($this->collsfGuardRememberKeys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collKomentarzes !== null) {
				foreach($this->collKomentarzes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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

			if ($this->collsfGuardUserProfiles !== null) {
				foreach($this->collsfGuardUserProfiles as $referrerFK) {
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


			if (($retval = sfGuardUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfGuardUserPermissions !== null) {
					foreach($this->collsfGuardUserPermissions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardUserGroups !== null) {
					foreach($this->collsfGuardUserGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardRememberKeys !== null) {
					foreach($this->collsfGuardRememberKeys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collKomentarzes !== null) {
					foreach($this->collKomentarzes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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

				if ($this->collsfGuardUserProfiles !== null) {
					foreach($this->collsfGuardUserProfiles as $referrerFK) {
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getAlgorithm();
				break;
			case 3:
				return $this->getSalt();
				break;
			case 4:
				return $this->getPassword();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getLastLogin();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getIsSuperAdmin();
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
		$keys = sfGuardUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getAlgorithm(),
			$keys[3] => $this->getSalt(),
			$keys[4] => $this->getPassword(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getLastLogin(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getIsSuperAdmin(),
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsername($value);
				break;
			case 2:
				$this->setAlgorithm($value);
				break;
			case 3:
				$this->setSalt($value);
				break;
			case 4:
				$this->setPassword($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setLastLogin($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setIsSuperAdmin($value);
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
		$keys = sfGuardUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlgorithm($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSalt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPassword($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastLogin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsSuperAdmin($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserPeer::ID)) $criteria->add(sfGuardUserPeer::ID, $this->id);
		if ($this->isColumnModified(sfGuardUserPeer::USERNAME)) $criteria->add(sfGuardUserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(sfGuardUserPeer::ALGORITHM)) $criteria->add(sfGuardUserPeer::ALGORITHM, $this->algorithm);
		if ($this->isColumnModified(sfGuardUserPeer::SALT)) $criteria->add(sfGuardUserPeer::SALT, $this->salt);
		if ($this->isColumnModified(sfGuardUserPeer::PASSWORD)) $criteria->add(sfGuardUserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(sfGuardUserPeer::CREATED_AT)) $criteria->add(sfGuardUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfGuardUserPeer::LAST_LOGIN)) $criteria->add(sfGuardUserPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(sfGuardUserPeer::IS_ACTIVE)) $criteria->add(sfGuardUserPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(sfGuardUserPeer::IS_SUPER_ADMIN)) $criteria->add(sfGuardUserPeer::IS_SUPER_ADMIN, $this->is_super_admin);

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
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		$criteria->add(sfGuardUserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of sfGuardUser (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUsername($this->username);

		$copyObj->setAlgorithm($this->algorithm);

		$copyObj->setSalt($this->salt);

		$copyObj->setPassword($this->password);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastLogin($this->last_login);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsSuperAdmin($this->is_super_admin);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getsfGuardUserPermissions() as $relObj) {
				$copyObj->addsfGuardUserPermission($relObj->copy($deepCopy));
			}

			foreach($this->getsfGuardUserGroups() as $relObj) {
				$copyObj->addsfGuardUserGroup($relObj->copy($deepCopy));
			}

			foreach($this->getsfGuardRememberKeys() as $relObj) {
				$copyObj->addsfGuardRememberKey($relObj->copy($deepCopy));
			}

			foreach($this->getKomentarzes() as $relObj) {
				$copyObj->addKomentarze($relObj->copy($deepCopy));
			}

			foreach($this->getTyps() as $relObj) {
				$copyObj->addTyp($relObj->copy($deepCopy));
			}

			foreach($this->getPunktys() as $relObj) {
				$copyObj->addPunkty($relObj->copy($deepCopy));
			}

			foreach($this->getsfGuardUserProfiles() as $relObj) {
				$copyObj->addsfGuardUserProfile($relObj->copy($deepCopy));
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
	 * @return     sfGuardUser Clone of current object.
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
	 * @return     sfGuardUserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfGuardUserPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collsfGuardUserPermissions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initsfGuardUserPermissions()
	{
		if ($this->collsfGuardUserPermissions === null) {
			$this->collsfGuardUserPermissions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserPermissions from storage.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getsfGuardUserPermissions($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
					$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;
		return $this->collsfGuardUserPermissions;
	}

	/**
	 * Returns the number of related sfGuardUserPermissions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countsfGuardUserPermissions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

		return sfGuardUserPermissionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a sfGuardUserPermission object to this object
	 * through the sfGuardUserPermission foreign key attribute
	 *
	 * @param      sfGuardUserPermission $l sfGuardUserPermission
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardUserPermission(sfGuardUserPermission $l)
	{
		$this->collsfGuardUserPermissions[] = $l;
		$l->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserPermissions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getsfGuardUserPermissionsJoinsfGuardPermission($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con);
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;

		return $this->collsfGuardUserPermissions;
	}

	/**
	 * Temporary storage of collsfGuardUserGroups to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initsfGuardUserGroups()
	{
		if ($this->collsfGuardUserGroups === null) {
			$this->collsfGuardUserGroups = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserGroups from storage.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getsfGuardUserGroups($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
					$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;
		return $this->collsfGuardUserGroups;
	}

	/**
	 * Returns the number of related sfGuardUserGroups.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countsfGuardUserGroups($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

		return sfGuardUserGroupPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a sfGuardUserGroup object to this object
	 * through the sfGuardUserGroup foreign key attribute
	 *
	 * @param      sfGuardUserGroup $l sfGuardUserGroup
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardUserGroup(sfGuardUserGroup $l)
	{
		$this->collsfGuardUserGroups[] = $l;
		$l->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getsfGuardUserGroupsJoinsfGuardGroup($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con);
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;

		return $this->collsfGuardUserGroups;
	}

	/**
	 * Temporary storage of collsfGuardRememberKeys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initsfGuardRememberKeys()
	{
		if ($this->collsfGuardRememberKeys === null) {
			$this->collsfGuardRememberKeys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardRememberKeys from storage.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getsfGuardRememberKeys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardRememberKeyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardRememberKeys === null) {
			if ($this->isNew()) {
			   $this->collsfGuardRememberKeys = array();
			} else {

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->getId());

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->getId());

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardRememberKeyCriteria) || !$this->lastsfGuardRememberKeyCriteria->equals($criteria)) {
					$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardRememberKeyCriteria = $criteria;
		return $this->collsfGuardRememberKeys;
	}

	/**
	 * Returns the number of related sfGuardRememberKeys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countsfGuardRememberKeys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardRememberKeyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->getId());

		return sfGuardRememberKeyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a sfGuardRememberKey object to this object
	 * through the sfGuardRememberKey foreign key attribute
	 *
	 * @param      sfGuardRememberKey $l sfGuardRememberKey
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardRememberKey(sfGuardRememberKey $l)
	{
		$this->collsfGuardRememberKeys[] = $l;
		$l->setsfGuardUser($this);
	}

	/**
	 * Temporary storage of collKomentarzes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initKomentarzes()
	{
		if ($this->collKomentarzes === null) {
			$this->collKomentarzes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously
	 * been saved, it will retrieve related Komentarzes from storage.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getKomentarzes($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseKomentarzePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKomentarzes === null) {
			if ($this->isNew()) {
			   $this->collKomentarzes = array();
			} else {

				$criteria->add(KomentarzePeer::USER_ID, $this->getId());

				KomentarzePeer::addSelectColumns($criteria);
				$this->collKomentarzes = KomentarzePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(KomentarzePeer::USER_ID, $this->getId());

				KomentarzePeer::addSelectColumns($criteria);
				if (!isset($this->lastKomentarzeCriteria) || !$this->lastKomentarzeCriteria->equals($criteria)) {
					$this->collKomentarzes = KomentarzePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastKomentarzeCriteria = $criteria;
		return $this->collKomentarzes;
	}

	/**
	 * Returns the number of related Komentarzes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countKomentarzes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseKomentarzePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(KomentarzePeer::USER_ID, $this->getId());

		return KomentarzePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Komentarze object to this object
	 * through the Komentarze foreign key attribute
	 *
	 * @param      Komentarze $l Komentarze
	 * @return     void
	 * @throws     PropelException
	 */
	public function addKomentarze(Komentarze $l)
	{
		$this->collKomentarzes[] = $l;
		$l->setsfGuardUser($this);
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
	 * Otherwise if this sfGuardUser has previously
	 * been saved, it will retrieve related Typs from storage.
	 * If this sfGuardUser is new, it will return
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

				$criteria->add(TypPeer::USER_ID, $this->getId());

				TypPeer::addSelectColumns($criteria);
				$this->collTyps = TypPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TypPeer::USER_ID, $this->getId());

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

		$criteria->add(TypPeer::USER_ID, $this->getId());

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
		$l->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Typs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getTypsJoinMecz($criteria = null, $con = null)
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

				$criteria->add(TypPeer::USER_ID, $this->getId());

				$this->collTyps = TypPeer::doSelectJoinMecz($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TypPeer::USER_ID, $this->getId());

			if (!isset($this->lastTypCriteria) || !$this->lastTypCriteria->equals($criteria)) {
				$this->collTyps = TypPeer::doSelectJoinMecz($criteria, $con);
			}
		}
		$this->lastTypCriteria = $criteria;

		return $this->collTyps;
	}

	/**
	 * Temporary storage of collPunktys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPunktys()
	{
		if ($this->collPunktys === null) {
			$this->collPunktys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously
	 * been saved, it will retrieve related Punktys from storage.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPunktys($criteria = null, $con = null)
	{
		// include the Peer class
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

				$criteria->add(PunktyPeer::USER_ID, $this->getId());

				PunktyPeer::addSelectColumns($criteria);
				$this->collPunktys = PunktyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PunktyPeer::USER_ID, $this->getId());

				PunktyPeer::addSelectColumns($criteria);
				if (!isset($this->lastPunktyCriteria) || !$this->lastPunktyCriteria->equals($criteria)) {
					$this->collPunktys = PunktyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPunktyCriteria = $criteria;
		return $this->collPunktys;
	}

	/**
	 * Returns the number of related Punktys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPunktys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePunktyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PunktyPeer::USER_ID, $this->getId());

		return PunktyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Punkty object to this object
	 * through the Punkty foreign key attribute
	 *
	 * @param      Punkty $l Punkty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPunkty(Punkty $l)
	{
		$this->collPunktys[] = $l;
		$l->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Punktys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 */
	public function getPunktysJoinTurniej($criteria = null, $con = null)
	{
		// include the Peer class
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

				$criteria->add(PunktyPeer::USER_ID, $this->getId());

				$this->collPunktys = PunktyPeer::doSelectJoinTurniej($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PunktyPeer::USER_ID, $this->getId());

			if (!isset($this->lastPunktyCriteria) || !$this->lastPunktyCriteria->equals($criteria)) {
				$this->collPunktys = PunktyPeer::doSelectJoinTurniej($criteria, $con);
			}
		}
		$this->lastPunktyCriteria = $criteria;

		return $this->collPunktys;
	}

	/**
	 * Temporary storage of collsfGuardUserProfiles to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initsfGuardUserProfiles()
	{
		if ($this->collsfGuardUserProfiles === null) {
			$this->collsfGuardUserProfiles = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserProfiles from storage.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getsfGuardUserProfiles($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getId());

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getId());

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $this->collsfGuardUserProfiles;
	}

	/**
	 * Returns the number of related sfGuardUserProfiles.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countsfGuardUserProfiles($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getId());

		return sfGuardUserProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a sfGuardUserProfile object to this object
	 * through the sfGuardUserProfile foreign key attribute
	 *
	 * @param      sfGuardUserProfile $l sfGuardUserProfile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfGuardUserProfile(sfGuardUserProfile $l)
	{
		$this->collsfGuardUserProfiles[] = $l;
		$l->setsfGuardUser($this);
	}

} // BasesfGuardUser
