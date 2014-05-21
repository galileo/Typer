<?php


/**
 * This class adds structure of 'typy_mecz' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MeczMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MeczMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('typy_mecz');
		$tMap->setPhpName('Mecz');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TURNIEJ_ID', 'TurniejId', 'int', CreoleTypes::INTEGER, 'typy_turniej', 'ID', false, null);

		$tMap->addColumn('ZESPOL1', 'Zespol1', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('ZESPOL2', 'Zespol2', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('GOLE1', 'Gole1', 'int', CreoleTypes::INTEGER, false, 2);

		$tMap->addColumn('GOLE2', 'Gole2', 'int', CreoleTypes::INTEGER, false, 2);

		$tMap->addColumn('DATA', 'Data', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('AKTYWNY', 'Aktywny', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ROZEGRANY', 'Rozegrany', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('STATUS', 'Status', 'int', CreoleTypes::INTEGER, false, 2);

		$tMap->addColumn('TYPY_ILOSC', 'TypyIlosc', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // MeczMapBuilder
