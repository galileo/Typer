<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Tournament
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $image;

    /**
     * @var
     */
    protected $isActive;

    /**
     * @var
     */
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
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        return $this->isActive;
    }



    /**
     * @return mixed
     */
    public function getTournamentStages()
    {
        return $this->tournamentStages;
    }


    /**
     * Alias for getTournamentStages
     */
    public function getStages()
    {
        return $this->getTournamentStages();
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