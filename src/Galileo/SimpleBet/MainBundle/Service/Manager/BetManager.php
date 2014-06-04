<?php

namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Player;

use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Entity\Score;
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
        $score = new Score();
        $score
            ->setHome(0)
            ->setAway(0)
            ->setScoreType('simple');

        $bet = new Bet();
        $bet->setScore($score);
        $bet->setGame($game);
        $bet->setIsActive(true);
        $bet->setPointsEarned(0);
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
        $bet = $this->findBet($player, $game);
        if (null === $bet) {
            $bet = $this->createEntity($player, $game);
        }

        return $bet;
    }
}