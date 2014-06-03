<?php
namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Player;

interface BetManagerInterface
{
    /**
     * @return Bet
     */
    public function createEntity();

    /**
     * @param Player $player
     * @param Game $game
     *
     * @return Bet
     */
    public function findBet(Player $player, Game $game);
}