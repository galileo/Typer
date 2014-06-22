<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\MainBundle\Service\Manager\GameManagerInterface;
use Galileo\SimpleBet\MainBundle\Service\Manager\BetManagerInterface;

use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\ModelBundle\Form\Type\BetScoreType;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BetController
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var GameManagerInterface
     */
    protected $gameManager;

    /**
     * @var CurrentPlayerManager
     */
    protected $playerManager;

    /**
     * @var BetManagerInterface
     */
    protected $betManager;

    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var Router
     */
    protected $router;

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
    protected $scoreRepository;

    public function __construct(EngineInterface $templating,
                                FormFactory $formFactory,
                                GameManagerInterface $gameManager,
                                CurrentPlayerManager $currentPlayerManager,
                                BetManagerInterface $betManager,
                                EntityManager $entityManager,
                                EntityRepository $scoreRepository,
                                Router $router,
                                Session $session
    )
    {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->gameManager = $gameManager;
        $this->playerManager = $currentPlayerManager;
        $this->betManager = $betManager;
        $this->entityManager = $entityManager;
        $this->router = $router;

        $this->player = $this->playerManager->getCurrentPlayer();
        $this->session = $session;
        $this->scoreRepository = $scoreRepository;
    }

    public function betAction(Request $request, $gameId)
    {
        try {
            $game = $this->gameManager->findGameOrFail($gameId);
            $tournament = $game->getTournamentStage()->getTournament();
            $tournamentStage = $game->getTournamentStage();
            $bet = $this->betManager->getBetOrCreate($this->player, $game);
        } catch (NotFoundResourceException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        if (!$game->getIsActive()) {
            $this->setNotAvailableMessage();

            return $this->redirect(
                $this->gameUrl($gameId, $tournament->getId(), $tournamentStage->getId())
            );
        }

        $form = $this->formFactory->create(new BetScoreType($this->entityManager), $bet);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->persist($bet);
            $this->entityManager->flush();
        }

        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Bet:bet.html.twig', array(
                'form' => $form->createView(),
                'game' => $game,
                'stage' => $game->getTournamentStage(),
                'tournament' => $game->getTournamentStage()->getTournament(),
            )
        );
    }

    public function viewAction($gameId)
    {
        $game = $this->gameManager->findGameOrFail($gameId);

        if (!$this->player instanceof Player) {
            throw new AccessDeniedException('Ups');
        }

        $bet = $this->betManager->getBetOrCreate(
            $this->player,
            $game
        );

        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Bet:view.html.twig', array(
                'game' => $game,
                'bet' => $bet,

            )
        );

    }

    /**
     * @param string $url
     *
     * @return RedirectResponse
     */
    protected function redirect($url)
    {
        return new RedirectResponse(
            $url,
            302
        );
    }

    protected function gameUrl($gameId, $tournamentId, $stageId)
    {
        return $this->router->generate(
            'gsbm_tournament_stage_game_view', array(
                'tournamentId' => $tournamentId,
                'stageId' => $stageId,
                'gameId' => $gameId,
            )
        );
    }

    protected function setNotAvailableMessage()
    {
        $this->session->getFlashBag()->add(
            'error',
            'Zmiana lub dodanie typu nie jest możliwa'
        );
    }
} 