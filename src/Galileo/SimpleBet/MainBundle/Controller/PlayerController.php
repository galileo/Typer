<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Exception;
use Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager;
use Galileo\SimpleBet\MainBundle\Service\Manager\PlayerToTournamentManagerInterface;
use Galileo\SimpleBet\MainBundle\Service\Provider\PointsProviderInterface;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\PlayerToTournament;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PlayerController
{
    /**
     * @var PlayerToTournamentManagerInterface
     */
    protected $playerToTournamentManager;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var EntityRepository
     */
    protected $tournamentRepository;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Tournament
     */
    protected $tournament;

    /**
     * @var Player
     */
    protected $player;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var EntityRepository
     */
    protected $playerRepository;

    /**
     * @var PointsProviderInterface
     */
    protected $todayPointsProvider;

    function __construct(CurrentPlayerManager $currentPlayerManager,
                         EntityRepository $tournamentRepository,
                         EntityRepository $playerRepository,
                         PlayerToTournamentManagerInterface $playerToTournamentManager,
                         EngineInterface $templating,
                         Router $router,
                         Session $session,
                         PointsProviderInterface $pointsProviderInterface
    )
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->playerToTournamentManager = $playerToTournamentManager;
        $this->templating = $templating;
        $this->router = $router;
        $this->session = $session;

        $this->player = $currentPlayerManager->getCurrentPlayer();
        $this->playerRepository = $playerRepository;
        $this->todayPointsProvider = $pointsProviderInterface;
    }

    /**
     * @param $tournamentId
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function joinTournamentAction($tournamentId)
    {
        $playerToTournament = $this->loadPlayerToTournament($tournamentId);

        if (null === $playerToTournament) {
            $playerToTournament = $this->joinIntoTournament();
            $this->messageSuccessJoin($playerToTournament);
        } else {
            $this->messageRepeatJoinTry();
        }

        return new RedirectResponse($this->tournamentUrl($tournamentId), 302);
    }

    /**
     * @param $tournamentId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewPlayerToTournamentAction($tournamentId)
    {
        $playerToTournament = $this->loadPlayerToTournament($tournamentId);

        return $this->templating
            ->renderResponse('GalileoSimpleBetMainBundle:Tournament:playerStatusBar.html.twig', array(
                    'tournament'         => $this->tournament,
                    'playerToTournament' => $playerToTournament
                )
            );
    }

    public function bestPlayerAction()
    {
        $bestPlayers = $this->playerRepository->findBestPlayers();

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Player:playerStatsTable.html.twig',
            array('playerStats' => $bestPlayers)
        );
    }

    public function tournamentPlayerStatsAction($tournament, $limit = null)
    {
        $playerStats = $this->playerRepository->tournamentPlayerStats($tournament, $limit);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Player:playerStatsTable.html.twig',
            array(
                'playerStats' => $playerStats,
                'todayPoints' => $this->todayPointsProvider
            )
        );
    }

    /**
     * @param $tournamentId
     *
     * @throws NotFoundHttpException
     * @return Tournament
     */
    protected function loadTournamentOrFail($tournamentId)
    {
        $this->tournament = $this->tournamentRepository->find($tournamentId);

        if (null === $this->tournament) {
            throw new NotFoundHttpException(sprintf('Tournament with id %d was not found.', $tournamentId));
        }

        return $this->tournament;
    }

    /**
     * @param $tournamentId
     *
     * @return string
     */
    protected function tournamentUrl($tournamentId)
    {
        return $this->router->generate('gsbm_tournament_view', array('tournamentId' => $tournamentId));
    }

    /**
     * @return PlayerToTournament
     * @throws Exception
     */
    protected function joinIntoTournament()
    {
        if (null == $this->player) {
            throw new Exception('Player not recognized');
        }

        if (null === $this->tournament) {
            throw new Exception('Tournament not recognized');
        }

        return $this->playerToTournamentManager->joinPlayerIntoTournament(
            $this->getPlayer(),
            $this->tournament
        );
    }

    /**
     * @param PlayerToTournament $playerToTournament
     */
    protected function messageSuccessJoin(PlayerToTournament $playerToTournament)
    {
        if ($playerToTournament->isActive()) {
            $message = 'Zostałeś dodany! Automatyczna aktywacja przebiegła pomyślnie.';
        } else {
            $message = 'Zostałeś dodany! Turniej ten jednak wymaga potwierdzenia uczestnictwa od autora.';
        }

        $this->session->getFlashBag()->add('success', $message);
    }

    protected function messageRepeatJoinTry()
    {
        $this->session->getFlashBag()->add(
            'error',
            'Jesteś już zgłoszony do tego turnieju!'
        );
    }

    /**
     * @param $tournamentId
     *
     * @return PlayerToTournament
     */
    protected function loadPlayerToTournament($tournamentId)
    {
        $this->loadTournamentOrFail($tournamentId);

        $playerToTournament = $this->playerToTournamentManager->getPlayerToTournament(
            $this->getPlayer(),
            $this->tournament
        );

        return $playerToTournament;
    }

    /**
     * @return Player
     */
    protected function getPlayer()
    {
        if (!$this->player instanceof Player){
            throw new AccessDeniedException('Please log in.');
        }

        return $this->player;
    }
} 