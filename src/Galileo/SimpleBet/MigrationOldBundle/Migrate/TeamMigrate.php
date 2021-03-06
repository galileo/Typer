<?php

namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;

use Galileo\SimpleBet\ModelBundle\Entity\Team;

class TeamMigrate extends Write
{
    protected $teamObjects;

    /**
     * @var
     */
    private $mysqlLink;

    protected $teams = array();

    public function __construct($mysqlLink, $em, \Symfony\Component\Console\Output\OutputInterface $output = null)
    {
        $this->mysqlLink = $mysqlLink;
        $this->em = $em;
        $this->output = $output;
    }

    public function execute()
    {
        $tempArray = array();

        $stmt = mysqli_query($this->mysqlLink, 'SELECT zespol1, zespol2 FROM typy_mecz');
        $rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

        foreach ($rows as $row) {
            $tempArray[] = $row['zespol1'];
            $tempArray[] = $row['zespol2'];
        }

        $tempArray = array_unique($tempArray);

        foreach ($tempArray as $teamName) {
            $team = $this->findByName($teamName);

            if (!$team) {
                $team = new Team();
                $team->setName($teamName);

                $this->save($team);
            }

            $this->addTeam($teamName, $team->getId(), $team);
        }
    }

    public function getNewIdByOldName($name)
    {
        return array_search($name, $this->teams);
    }

    public function getNameByNewId($id)
    {
        return $this->teams[$id];
    }

    public function getTeamObject($id)
    {
        return $this->teamObjects[$id];
    }

    protected function addTeam($name, $id, $team)
    {
        $this->teams[$id] = $name;
        $this->teamObjects[$id] = $team;
    }

    protected function findByName($teamName)
    {
        return $this->em->getRepository('GalileoSimpleBetModelBundle:Team')->findOneByName($teamName);
    }
}
