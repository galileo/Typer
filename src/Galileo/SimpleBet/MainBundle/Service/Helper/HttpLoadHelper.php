<?php

namespace Galileo\SimpleBet\MainBundle\Service\Helper;

use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Repository\GameRepository;
use Galileo\SimpleBet\ModelBundle\Repository\PlayerRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HttpLoadHelper
{
    /**
     * @var PlayerRepository
     */
    protected $playerRepository;

    /**
     * @var EntityRepository
     */
    protected $tournamentRepository;

    /**
     * @var GameRepository
     */
    protected $gameRepository;

    public function __construct(PlayerRepository $playerRepository,
                                EntityRepository $tournamentRepository,
                                GameRepository $gameRepository
    )
    {
        $this->playerRepository = $playerRepository;
        $this->tournamentRepository = $tournamentRepository;
        $this->gameRepository = $gameRepository;
    }

    public function loadTournamentOrFail($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);
        if (null === $tournament) {
            throw new NotFoundHttpException(sprintf('Tournament "%s" not found.', $tournamentId));
        }

        return $tournament;
    }

    public function loadPlayerOrFail($playerId)
    {
    }

    public function loadGameOrFail($gameId)
    {
    }
}
