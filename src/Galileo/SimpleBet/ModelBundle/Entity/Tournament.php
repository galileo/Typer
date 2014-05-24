<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Tournament
{
    protected $id;
    protected $name;
    protected $tournamentStages;

    public function __constructor()
    {
        $this->tournamentStages = new ArrayCollection();
    }


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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getTournamentStages()
    {
        return $this->tournamentStages;
    }

    /**
     * @param mixed $tournamentStage
     *
     * @return $this;
     */
    public function addTournamentStage(TournamentStage $tournamentStage)
    {
        $tournamentStage->setTournament($this);
        $this->tournamentStages[] = $tournamentStage;

        return $this;
    }
}