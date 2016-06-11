<?php

namespace Galileo\SimpleBet\MainBundle\Model;

use Galileo\SimpleBet\ModelBundle\Entity\Player;

class PlayerPointsModel
{
    /**
     * @var Player
     */
    protected $player;
    protected $points;
    protected $entries;
    protected $recentPoints;

    public function __construct(Player $player, $entries, $points, $recentPoints)
    {
        $this->entries = $entries;
        $this->player = $player;
        $this->points = $points;
        $this->recentPoints = $recentPoints;
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
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function getRecentPoints()
    {
        return $this->recentPoints;
    }

}
