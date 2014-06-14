<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class Game
{
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $bets;

    protected $tournamentStage;

    protected $homeTeam;

    protected $awayTeam;

    protected $score;

    protected $date;

    protected $isActive;

    protected $isPlayed;

    /**
     * @var Bet
     */
    protected $yourBet;

    /**
     * @var bool
     */
    protected $availableForCurrentPlayer = false;

    public function __construct()
    {
        $this->bets = new ArrayCollection();
        $this->date = new DateTime();
    }


    /**
     * @return Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param Team $homeTeam
     *
     * @return Game
     */
    public function setHomeTeam(Team $homeTeam)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * @return Team
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param mixed $awayTeam
     */
    public function setAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return TournamentStage
     */
    public function getTournamentStage()
    {
        return $this->tournamentStage;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getIsPlayed()
    {
        return $this->isPlayed;
    }

    /**
     * @param mixed $isPlayed
     */
    public function setIsPlayed($isPlayed)
    {
        $this->isPlayed = $isPlayed;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @param mixed $tournamentStage
     */
    public function setTournamentStage($tournamentStage)
    {
        $this->tournamentStage = $tournamentStage;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Bet[]
     */
    public function getBets()
    {
        return $this->bets;
    }

    /**
     * @param Bet $bet
     *
     * @return $this
     */
    public function setYourBet(Bet $bet)
    {
        $this->yourBet = $bet;

        return $this;
    }

    /**
     * @return Bet
     */
    public function getYourBet()
    {
        return $this->yourBet;
    }

    public function canShowOtherBets()
    {
        $notActive = !$this->isActive;

        return $notActive;
    }

    /**
     * @return $this
     */
    public function markAsAvailableForCurrentPlayer()
    {
        $this->availableForCurrentPlayer = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function availableForCurrentPlayer()
    {
        return $this->availableForCurrentPlayer;
    }

    public function equals(Game $game)
    {
        return $game->getId() == $this->getId();
    }
}