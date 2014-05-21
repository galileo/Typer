<?php



class OsobaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.OsobaMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('typy_osoba');
		$tMap->setPhpName('Osoba');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('LOGIN', 'Login', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('HASLO', 'Haslo', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('MAIL', 'Mail', 'string', CreoleTypes::VARCHAR, true, 30);

		$tMap->addColumn('AKTYWNY', 'Aktywny', 'int', CreoleTypes::INTEGER, false, 1);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 