<?php


/**
 * This class adds structure of 'sf_guard_user_profile' table to 'propel' DatabaseMap object.
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
class sfGuardUserProfileMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.sfGuardUserProfileMapBuilder';

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

		$tMap = $this->dbMap->addTable('sf_guard_user_profile');
		$tMap->setPhpName('sfGuardUserProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('AKTYWNY', 'Aktywny', 'int', CreoleTypes::INTEGER, false, 1);

		$tMap->addColumn('BIRTHDAY', 'Birthday', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('PIENIADZE', 'Pieniadze', 'int', CreoleTypes::INTEGER, false, 2);

	} // doBuild()

} // sfGuardUserProfileMapBuilder
