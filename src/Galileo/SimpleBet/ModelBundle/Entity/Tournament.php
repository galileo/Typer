<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Tournament
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var bool
     */
    protected $isActive;

    /**
     * @var TournamentStage[]|ArrayCollection
     */
    protected $tournamentStages;

    /**
     * @var Player[]|ArrayCollection
     */
    protected $playersToTournament;

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }



    /**
     * @return TournamentStage[]
     */
    public function getTournamentStages()
    {
        return $this->tournamentStages;
    }


    /**
     * Alias for getTournamentStages
     * @return TournamentStage[]
     */
    public function getStages()
    {
        return $this->getTournamentStages();
    }

    /**
     * @return PlayerToTournament[]
     */
    public function getPlayerToTournament()
    {
        return $this->playersToTournament;
    }


    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param TournamentStage $tournamentStage
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