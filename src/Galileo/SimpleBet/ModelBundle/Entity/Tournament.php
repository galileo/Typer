<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

class Tournament
{
    protected $id;
    protected $name;
    protected $tournamentStages;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getTournamentStages()
    {
        return $this->tournamentStages;
    }

    /**
     * @param mixed $tournamentStages
     */
    public function addTournamentStages($tournamentStages)
    {
        $this->tournamentStages = $tournamentStages;
    }
}