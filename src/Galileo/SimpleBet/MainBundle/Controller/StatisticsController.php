<?php

namespace Galileo\SimpleBet\MainBundle\Controller;

use Doctrine\ORM\EntityRepository;
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

    public function __construct(
        EngineInterface $templating,
        BetStatisticsManagerInterface $betStatisticsManager,
        EntityRepository $tournamentRepository
    )
    {
        $this->templating = $templating;
        $this->tournamentRepository = $tournamentRepository;
        $this->betStatisticsManager = $betStatisticsManager;
    }

    public function getBetAccuracyStatsView($tournamentId)
    {
        $betStatistics = $this->betStatisticsManager->tournamentBetAccuracyStatistics($tournamentId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Statistics:viewBetAccuracy.html.twig', array(
                'betStatistics' => $betStatistics
            )
        );
    }

    public function playerTournamentAccuracyStatisticsView($tournamentId)
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
        $tournament = $this->tournamentRepository->find($tournamentId);

        $bestBettedGames = $this->betStatisticsManager->bestBettedGames($tournamentId, $limit = 5);
        $worstBettedGames = $this->betStatisticsManager->worstBettedGames($tournamentId, $limit = 5);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Statistics:bestBettedGamesView.html.twig',
            array('tournament' => $tournament,
                'bestBettedGames' => $bestBettedGames,
                'worstBettedGames' => $worstBettedGames,
            )
        );
    }


} 