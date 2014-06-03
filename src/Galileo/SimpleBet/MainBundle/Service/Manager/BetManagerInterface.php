<?php
namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

interface BetManagerInterface
{
    /**
     * @param Player $player
     * @param Game $game
     *
     * @return Bet
     */
    public function createEntity(Player $player, Game $game);

    /**
     * @param Player $player
     * @param Game $game
     *
     * @throws ResourceNotFoundException
     *
     * @return Bet
     */
    public function findBet(Player $player, Game $game);

    /**
     * @param Player $player
     * @param Game $game
     *
     * @return Bet
     */
    public function getBetOrCreate(Player $player, Game $game);
}