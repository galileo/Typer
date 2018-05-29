<?php

namespace Galileo\SimpleBet\ModelBundle\Entity;

class TournamentStage
{

    protected $id;
    protected $name;
    protected $type; // Group Stage, Cup stage etc
    protected $games;
    protected $tournament;

    public function __toString()
    {
        return $this->getTournament()->getName() . ' > ' .$this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * @param mixed $tournament
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;
    }

    public function setTableProvider()
    {

    }

    public function getTable()
    {

        $this->tableProvider->getTable();

        return $this->table;
    }
}
