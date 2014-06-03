<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class GameManager implements GameManagerInterface
{
    /**
     * @var EntityRepository
     */
    protected $gameRepository;

    public function __construct(EntityRepository $gameRepository) {

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
} 