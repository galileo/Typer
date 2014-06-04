<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class GameManager implements GameManagerInterface
{
    /**
     * @var EntityRepository
     */
    protected $gameRepository;

    public function __construct(EntityRepository $gameRepository)
    {

        $this->gameRepository = $gameRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function findGameOrFail($gameId)
    {
        $game = $this->gameRepository->find($gameId);

        if (null === $game) {
            throw new NotFoundResourceException(sprintf('Game %d not found.', $gameId));
        }

        return $game;
    }

    /**
     * @param Game $game
     *
     * @return bool
     */
    public function isBettingAvailable(Game $game)
    {
        $gameDate = $game->getDate();

        $now = new \DateTime();
        $now->add(new \DateInterval('PT1H'));

        if ($now > $gameDate) {
            return false;
        }

        return true;
    }
} 