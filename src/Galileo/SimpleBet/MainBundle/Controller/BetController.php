<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager;
use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\Score;
use Galileo\SimpleBet\MainBundle\Service\Manager\GameManagerInterface;
use Galileo\SimpleBet\MainBundle\Service\Manager\BetManagerInterface;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

    public function __construct(EngineInterface $templating,
                                FormFactory $formFactory,
                                GameManagerInterface $gameManager,
                                CurrentPlayerManager $currentPlayerManager,
                                BetManagerInterface $betManager,
                                EntityManager $entityManager,
                                Router $router
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
    }

    public function betAction(Request $request, $gameId)
    {
        try {
            $game = $this->gameManager->findGameOrFail($gameId);
        } catch (NotFoundResourceException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        if (!$game->isBetAble()) {
            return $this->redirect($this->gameUrl($game->getId()));
        }

        $bet = $this->betManager->getBetOrCreate($this->player, $game);

        $score = $bet->getScore();

        $form = $this->formFactory
            ->createBuilder('form', $score)
            ->add('home', 'integer')
            ->add('away', 'integer')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->persist($bet);
            $this->entityManager->persist($score);
            $this->entityManager->flush();

            return $this->redirect(
                $this->gameUrl(
                    $game->getId(),
                    $game->getTournamentStage()->getTournament()->getId()
                )
            );
        }


        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Bet:bet.html.twig', array(
                'form' => $form->createView(),
                'game' => $game
            )
        );
    }

    public function viewAction($gameId)
    {
        $game = $this->gameManager->findGameOrFail($gameId);

        if (!$this->player instanceof Player) {
            throw new AccessDeniedException('Ups');
        }


        $bet = $this->betManager->findBet(
            $this->player,
            $game
        );

        if (null === $bet) {
            $bet = new Bet();
        }


        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Bet:view.html.twig', array(
                'game' => $game,
                'bet'  => $bet
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

    private function gameUrl($gameId, $tournamentId)
    {
        return $this->router->generate(
            'gsbm_tournament_view_game_bets', array(
                'tournamentId' => $tournamentId,
                'gameId'       => $gameId
            )
        );
    }
} 