<?php


namespace Galileo\SimpleBet\ModelBundle\Entity;


class TournamentPlayer
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Player
     */
    protected $player;

    /**
     * @var Tournament
     */
    protected $tournament;

    /**
     * @var boolean
     */
    protected $isActive;

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }
}