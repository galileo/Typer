<?php
namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\MainBundle\Statistics\BetStatistics;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;

interface BetStatisticsManagerInterface
{

    /**
     * @param $tournamentId
     *
     * @return BetStatistics
     */
    public function tournamentBetAccuracyStatistics($tournamentId);

    /**
     * @param Player $player
     * @param Tournament $tournament
     *
     * @return BetStatistics
     */
    public function playerTournamentBetAccuracyStatistics(Player $player, Tournament $tournament);

    /**
     * @param Tournament $tournament
     *
     * @return array
     */
    public function tournamentPlayerBetAccuracy(Tournament $tournament);

    public function bestBettedGames($tournamentId, $limit = null);

}