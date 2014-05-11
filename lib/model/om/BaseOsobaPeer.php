<?php


abstract class BaseOsobaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'typy_osoba';

	
	const CLASS_DEFAULT = 'lib.model.Osoba';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'typy_osoba.ID';

	
	const LOGIN = 'typy_osoba.LOGIN';

	
	const HASLO = 'typy_osoba.HASLO';

	
	const MAIL = 'typy_osoba.MAIL';

	
	const AKTYWNY = 'typy_osoba.AKTYWNY';

	
	const CREATED_AT = 'typy_osoba.CREATED_AT';

	
	const UPDATED_AT = 'typy_osoba.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Login', 'Haslo', 'Mail', 'Aktywny', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (OsobaPeer::ID, OsobaPeer::LOGIN, OsobaPeer::HASLO, OsobaPeer::MAIL, OsobaPeer::AKTYWNY, OsobaPeer::CREATED_AT, OsobaPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'login', 'haslo', 'mail', 'aktywny', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Login' => 1, 'Haslo' => 2, 'Mail' => 3, 'Aktywny' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (OsobaPeer::ID => 0, OsobaPeer::LOGIN => 1, OsobaPeer::HASLO => 2, OsobaPeer::MAIL => 3, OsobaPeer::AKTYWNY => 4, OsobaPeer::CREATED_AT => 5, OsobaPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'login' => 1, 'haslo' => 2, 'mail' => 3, 'aktywny' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OsobaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OsobaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OsobaPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(OsobaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OsobaPeer::ID);

		$criteria->addSelectColumn(OsobaPeer::LOGIN);

		$criteria->addSelectColumn(OsobaPeer::HASLO);

		$criteria->addSelectColumn(OsobaPeer::MAIL);

		$criteria->addSelectColumn(OsobaPeer::AKTYWNY);

		$criteria->addSelectColumn(OsobaPeer::CREATED_AT);

		$criteria->addSelectColumn(OsobaPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(typy_osoba.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT typy_osoba.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OsobaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OsobaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OsobaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = OsobaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OsobaPeer::populateObjects(OsobaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OsobaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OsobaPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return OsobaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OsobaPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(OsobaPeer::ID);
			$selectCriteria->add(OsobaPeer::ID, $criteria->remove(OsobaPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(OsobaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(OsobaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Osoba) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OsobaPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Osoba $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OsobaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OsobaPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(OsobaPeer::DATABASE_NAME, OsobaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OsobaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(OsobaPeer::DATABASE_NAME);

		$criteria->add(OsobaPeer::ID, $pk);


		$v = OsobaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(OsobaPeer::ID, $pks, Criteria::IN);
			$objs = OsobaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOsobaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OsobaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OsobaMapBuilder');
}
