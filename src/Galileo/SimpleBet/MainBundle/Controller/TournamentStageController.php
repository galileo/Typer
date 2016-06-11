<?php

namespace Galileo\SimpleBet\MainBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\MainBundle\Service\Manager\TableManagerInterface;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TournamentStageController
{
    /**
     * @var EngineInterface
     */
    protected $templateEngine;

    /**
     * @var EntityRepository
     */
    protected $stageRepository;

    /**
     * @var EntityRepository
     */
    protected $gameRepository;

    /**
     * @var TableManagerInterface
     */
    protected $tableManager;

    public function __construct(EngineInterface $templateEngine,
                                EntityRepository $stageRepository,
                                EntityRepository $gameRepository,
                                TableManagerInterface $tableManager
    )
    {
        $this->templateEngine = $templateEngine;
        $this->stageRepository = $stageRepository;
        $this->gameRepository = $gameRepository;
        $this->tableManager = $tableManager;
    }

    public function viewStageAction($tournamentId, $stageId)
    {
        $stage = $this->loadOrFail($stageId);

        return $this->templateEngine->renderResponse('GalileoSimpleBetMainBundle:TournamentStage:view.html.twig', array(
                'stage'      => $stage,
                'tournament' => $stage->getTournament(),
            )
        );
    }

    public function viewStageGameAction($tournamentId, $stageId, $gameId)
    {
        $stage = $this->loadOrFail($stageId);
        $game = $this->loadGameOrFail($gameId);

        return $this->templateEngine->renderResponse('GalileoSimpleBetMainBundle:TournamentStage:view.html.twig', array(
                'stage'       => $stage,
                'tournament'  => $stage->getTournament(),
                'currentGame' => $game,
                'table'=> $this->tableManager->generateTable($stage),
            )
        );
    }

    /**
     * @param $stageId
     *
     * @return TournamentStage
     */
    protected function loadOrFail($stageId)
    {
        $tournamentStage = $this->stageRepository->find($stageId);
        if (null === $tournamentStage) {
            throw new NotFoundHttpException('Stage not found');
        }

        return $tournamentStage;
    }

    /**
     * @param $gameId
     *
     * @return Game
     */
    protected function loadGameOrFail($gameId)
    {
        $game = $this->gameRepository->find($gameId);
        if (null === $game) {
            throw new NotFoundHttpException('Stage not found');
        }

        return $game;
    }

}
