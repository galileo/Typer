<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager;
use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Score;
use Galileo\SimpleBet\MainBundle\Service\Manager\GameManagerInterface;
use Galileo\SimpleBet\MainBundle\Service\Manager\BetManagerInterface;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
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

    public function __construct(EngineInterface $templating,
                                FormFactory $formFactory,
                                GameManagerInterface $gameManager,
                                CurrentPlayerManager $currentPlayerManager,
                                BetManagerInterface $betManager,
                                EntityManager $entityManager
    )
    {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->gameManager = $gameManager;
        $this->playerManager = $currentPlayerManager;
        $this->betManager = $betManager;
        $this->entityManager = $entityManager;
    }

    public function betAction(Request $request, $gameId)
    {
        try {
            $game = $this->gameManager->findGameOrFail($gameId);
            $player = $this->playerManager->getLoggedOrFail();
        } catch (NotFoundResourceException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        $bet = $this->betManager->getBetOrCreate($player, $game);

        $score = $bet->getScore();

        $form = $this->formFactory
            ->createBuilder('form', $score)
            ->add('away', 'integer')
            ->add('home', 'integer')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->persist($score);
            $this->entityManager->flush();
        }


        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Bet:bet.html.twig', array(
                'form' => $form->createView(),
            )
        );
    }

    public function viewAction($gameId)
    {
        $game = $this->gameManager->findGameOrFail($gameId);

        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Bet:view.html.twig', array(
                'game' => $game
            )
        );

    }
} 