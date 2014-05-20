<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

class Game
{
    protected $id;
    protected $bets;
    protected $tournamentStage;
    protected $homeTeam;
    protected $awayTeam;
    protected $score;
    protected $date;
    protected $isActive;
    protected $isPlayed;

    /**
     * @return mixed
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @return mixed
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

} 