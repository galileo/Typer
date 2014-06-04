<?php
namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\ModelBundle\Entity\Game;

interface GameManagerInterface
{
    /**
     * @param $gameId
     *
     * @return Game
     *
     * @throws \Symfony\Component\Translation\Exception\NotFoundResourceException
     */
    public function findGameOrFail($gameId);

    /**
     * @param Game $game
     *
     * @return bool
     */
    public function isBettingAvailable(Game $game);
}