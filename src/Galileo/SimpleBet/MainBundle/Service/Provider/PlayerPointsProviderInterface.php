<?php

namespace Galileo\SimpleBet\MainBundle\Service\Provider;

use Galileo\SimpleBet\ModelBundle\Entity\Player;

interface PlayerPointsProviderInterface {

    /**
     * @param Player $player
     * @return mixed
     */
    public function playerPoints(Player $player);
} 