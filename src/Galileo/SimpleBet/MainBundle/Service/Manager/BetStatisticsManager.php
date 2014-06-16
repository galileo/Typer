<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Galileo\SimpleBet\MainBundle\Statistics\BetStatistics;
use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Galileo\SimpleBet\ModelBundle\Repository\BetRepository;

class BetStatisticsManager implements BetStatisticsManagerInterface
{
    /**
     * @var BetRepository
     */
    protected $betRepository;

    public function __construct(BetRepository $betRepository)
    {

        $this->betRepository = $betRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function tournamentBetAccuracyStatistics($tournamentId)
    {
        $bets = $this->betRepository->findTournamentBets($tournamentId);

        return $this->createBetStatistics($bets);
    }

    /**
     * {@inheritdoc}
     */
    public function playerTournamentBetAccuracyStatistics(Player $player, Tournament $tournament)
    {
        $bets = $this->betRepository->findPlayerTournamentBets($player, $tournament);

        return $this->createBetStatistics($bets);
    }

    public function tournamentPlayerBetAccuracy(Tournament $tournament)
    {
        $playersToTournament = $tournament->getPlayerToTournament();

        $playerAndBets = array();

        foreach ($playersToTournament as $playerToTournament) {
            $player = $playerToTournament->getPlayer();
            $bets = $this->betRepository->findPlayerTournamentBets(
                $player,
                $tournament
            );
            $betStatistics = $this->createBetStatistics($bets);

            $playerAndBets[] = array(
                'player' => $player,
                'betStatistics' => $betStatistics
            );
        }

        return $playerAndBets;
    }


    /**
     * @param Bet[] $bets
     *
     * @return BetStatistics
     */
    protected function createBetStatistics($bets)
    {
        $betStatistics = new BetStatistics();

        foreach ($bets as $bet) {
            switch ($bet->getPointsEarned()) {
                case 3:
                    $betStatistics->increasePerfect();
                    break;
                case 1:
                    $betStatistics->increaseGood();
                    break;
                default:
                    $betStatistics->increaseBad();
            }
        }

        return $betStatistics;
    }

    public function bestBettedGames($tournamentId, $limit = null)
    {
        return $this->betRepository->bestBettedGames($tournamentId, $limit);
    }

    public function worstBettedGames($tournamentId, $limit = null)
    {
        return $this->betRepository->worstBettedGames($tournamentId, $limit);
    }
}