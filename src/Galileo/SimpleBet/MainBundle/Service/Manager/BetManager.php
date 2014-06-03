<?php

namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Player;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BetManager implements BetManagerInterface
{
    /**
     * @var EntityRepository
     */
    protected $betRepository;

    function __construct(EntityRepository $betRepository)
    {
        $this->betRepository = $betRepository;
    }


    /**
     * @param Player $player
     * @param Game $game
     *
     * @return Bet
     */
    public function createEntity(Player $player, Game $game)
    {
        $bet = new Bet();
        $bet->setGame($game);
        $bet->setPlayer($player);

        return $bet;
    }

    /**
     * @param Player $player
     * @param Game $game
     *
     * @throws NotFoundResourceException
     *
     * @return Bet
     */
    public function findBet(Player $player, Game $game)
    {
        $bet = $this->betRepository->findOneBy(array(
            'player' => $player,
            'game' => $game
        ));

        if (null === $bet) {
            throw new NotFoundResourceException(sprintf('Bet not found for game "%d" and "%s"',
                $game->getId(),
                $player->getDisplayName()
            ));
        }

        return $bet;
    }

    /**
     * @param Player $player
     * @param Game $game
     *
     * @return Bet
     */
    public function getBetOrCreate(Player $player, Game $game)
    {
        try {
            $bet = $this->findBet($player, $game);
        } catch (ResourceNotFoundException $e)
        {
            $bet = $this->createEntity($player, $game);
        }

        return $bet;
    }
}