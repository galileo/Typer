<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class GameManager implements GameManagerInterface
{
    /**
     * @var EntityRepository
     */
    protected $gameRepository;

    /**
     * @var Player
     */
    protected $loggedInPlayer;

    /**
     * @var PlayerToTournamentManagerInterface
     */
    protected $playerToTournamentManager;

    public function __construct(EntityRepository $gameRepository,
                                CurrentPlayerManager $playerManager,
                                PlayerToTournamentManagerInterface $playerToTournamentManager
    )
    {
        $this->loggedInPlayer = $playerManager->getCurrentPlayer();
        $this->gameRepository = $gameRepository;
        $this->playerToTournamentManager = $playerToTournamentManager;
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
        $player = $this->loggedInPlayer;
        if (!$player instanceof Player) {
            return false;
        }
        $tournament = $game->getTournamentStage()->getTournament();
        $playerToTournament = $this->playerToTournamentManager->getPlayerToTournament($player, $tournament);

        if (null === $playerToTournament) {
            return false;
        }

        if (!$playerToTournament->isActive()) {
            return false;
        }

        $gameDate = $game->getDate();

        $now = new \DateTime();
        $now->add(new \DateInterval('PT1H'));

        if ($now > $gameDate) {
            return false;
        }

        return true;
    }
} 