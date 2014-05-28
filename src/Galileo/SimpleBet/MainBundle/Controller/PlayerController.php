<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager;
use Galileo\SimpleBet\MainBundle\Service\Manager\PlayerToTournamentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlayerController
{
    /**
     * @var \Galileo\SimpleBet\MainBundle\Service\Manager\PlayerToTournamentManagerInterface
     */
    protected $playerToTournamentManager;

    /**
     * @var \Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager
     */
    protected $currentPlayerManager;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    protected $templating;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $tournamentRepository;

    function __construct(CurrentPlayerManager $currentPlayerManager,
                         EntityRepository $tournamentRepository,
                         PlayerToTournamentManagerInterface $playerToTournamentManager,
                         EngineInterface $templating
    )
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->playerToTournamentManager = $playerToTournamentManager;
        $this->currentPlayerManager = $currentPlayerManager;
        $this->templating = $templating;
    }

    public function joinTournament($tournamentId)
    {
        $tournament = $this->loadTournamentOrFail($tournamentId);

        $playerToTournament = $this->playerToTournamentManager->joinPlayerIntoTournament($this->currentPlayerManager->getCurrentPlayer(), $tournament);

        return $this->templating->renderResponse('@GalileoSimpleBetMain/Player/PlayerJoinsTournament.html.twig', array(
            'player_to_tournament' => $playerToTournament
        ));
    }

    /**
     * @param $tournamentId
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Galileo\SimpleBet\ModelBundle\Entity\Tournament
     */
    protected function loadTournamentOrFail($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);

        if (null === $tournament) {
            throw new NotFoundHttpException(sprintf('Tournament with id %d was not found.', $tournamentId));
        }

        return $tournament;
    }
} 