<?php

namespace Galileo\SimpleBet\ModelBundle\Providers;

use Galileo\SimpleBet\ModelBundle\Entity\Player;

class BetStats
{
    /**
     * @var integer
     */
    protected $totalPoints;

    /**
     * @var integer
     */
    protected $totalBets;

    /**
     * @var \Galileo\SimpleBet\ModelBundle\Entity\Player
     */
    protected $player;

    /**
     * @param Player $player
     *
     * @return \Galileo\SimpleBet\ModelBundle\Providers\BetStats|\Galileo\SimpleBet\ModelBundle\Entity\Player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return int
     */
    public function getTotalBets()
    {
        return $this->totalBets;
    }

    /**
     * @return int
     */
    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    /**
     * @return float
     */
    public function getPointsPerBet()
    {
        return $this->getTotalPoints() / $this->getTotalBets();
    }

    /**
     * @param int $totalBets
     */
    public function setTotalBets($totalBets)
    {
        $this->totalBets = $totalBets;
    }

    /**
     * @param int $totalPoints
     */
    public function setTotalPoints($totalPoints)
    {
        $this->totalPoints = $totalPoints;
    }
}
