<?php

namespace Galileo\SimpleBet\MainBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\MainBundle\Service\Factory\TournamentStagePlayerPointsFactory;
use Galileo\SimpleBet\MainBundle\Service\Helper\HttpLoadHelper;
use Galileo\SimpleBet\MainBundle\Service\Manager\BetStatisticsManagerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StatisticsController
{

    /**
     * @var EntityRepository
     */
    protected $tournamentRepository;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var BetStatisticsManagerInterface
     */
    protected $betStatisticsManager;

    /**
     * @var HttpLoadHelper
     */
    protected $httpLoadHelper;

    /**
     * @var TournamentStagePlayerPointsFactory
     */
    protected $stagePlayerPointsFactory;

    public function __construct(
        HttpLoadHelper $httpLoadHelper,
        EngineInterface $templating,
        BetStatisticsManagerInterface $betStatisticsManager,
        TournamentStagePlayerPointsFactory $stagePlayerPointsFactory,
        EntityRepository $tournamentRepository
    )
    {
        $this->httpLoadHelper = $httpLoadHelper;
        $this->templating = $templating;
        $this->tournamentRepository = $tournamentRepository;
        $this->betStatisticsManager = $betStatisticsManager;
        $this->stagePlayerPointsFactory = $stagePlayerPointsFactory;
    }

    public function getBetAccuracyStatsView($tournamentId)
    {
        $betStatistics = $this->betStatisticsManager->tournamentBetAccuracyStatistics($tournamentId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Statistics:viewBetAccuracy.html.twig', array(
                'betStatistics' => $betStatistics
            )
        );
    }

    public function playerTournamentAccuracyStatisticsViewAction($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);

        if (null === $tournament) {
            throw new NotFoundHttpException(sprintf('Tournament %d not found.', $tournamentId));
        }

        $playerAndBetStatistics = $this->betStatisticsManager->tournamentPlayerBetAccuracy($tournament);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Statistics:playerTournamentBetAccuracy.html.twig',
            array('tournament' => $tournament,
                'playerAndBetStatistics' => $playerAndBetStatistics)
        );
    }

    public function bestBetGamesAction($tournamentId)
    {
        $tournament = $this->httpLoadHelper->loadTournamentOrFail($tournamentId);

        $bestBettedGames = $this->betStatisticsManager->bestBettedGames($tournamentId, $limit = 5);
        $worstBettedGames = $this->betStatisticsManager->worstBettedGames($tournamentId, $limit = 5);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Statistics:bestBettedGamesView.html.twig',
            array('tournament' => $tournament,
                'bestBettedGames' => $bestBettedGames,
                'worstBettedGames' => $worstBettedGames,
            )
        );
    }

    public function stagePlayerStatisticsAction($tournamentId)
    {
        $tournament = $this->httpLoadHelper->loadTournamentOrFail($tournamentId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Statistics:stagePlayerStatisticsView.html.twig',
            array(
                'tournament' => $tournament,
                'pointFactory' => $this->stagePlayerPointsFactory
            )
        );
    }

}
