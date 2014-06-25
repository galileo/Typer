<?php

namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;

class TableManager implements TableManagerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    public function generateHomeTable(TournamentStage $tournamentStage)
    {
        // TODO: Implement generateHomeTable() method.
    }

    public function generateAwayTable(TournamentStage $tournamentStage)
    {
        // TODO: Implement generateAwayTable() method.
    }

    public function generateTable(TournamentStage $tournamentStage)
    {

        $sql = "SELECT
    t.*,
    SUM(games) games,
    SUM(wins) wins,
    SUM(draws) draws,
    SUM(losts) losts,
    SUM(goals_scored) goals_scored,
    SUM(goals_lost) goals_lost,
    SUM(goals_scored) - SUM(goals_lost) goals_diff,
    SUM(points) points
FROM (
    SELECT
        g.home_team_id team_id,
        SUM(IF(is_played, 1, 0)) games,
        SUM(IF(s.home > s.away, 1, 0)) wins,
        SUM(IF(s.home = s.away, 1, 0)) draws,
        SUM(IF(s.home < s.away, 1, 0)) losts,
        SUM(s.home) goals_scored,
        SUM(s.away) goals_lost,
        SUM(IF(s.home > s.away, 3, IF(s.home = s.away, 1, 0))) points
    FROM gsbm_game g
    LEFT JOIN gsbm_score s ON s.id = g.score_id
    WHERE tournament_stage_id = ?
    GROUP BY g.home_team_id
UNION(
    SELECT
        g.away_team_id team_id,
        SUM(IF(is_played, 1, 0)) games,
        SUM(IF(s.home < s.away, 1, 0)) wins,
        SUM(IF(s.home = s.away, 1, 0)) draws,
        SUM(IF(s.home > s.away, 1, 0)) losts,
        SUM(s.away) goals_scored,
        SUM(s.home) goals_lost,
        SUM(IF(s.home < s.away, 3, IF(s.home = s.away, 1, 0))) points
    FROM gsbm_game g
    LEFT JOIN gsbm_score s ON s.id = g.score_id
    WHERE tournament_stage_id = ?
    GROUP BY g.away_team_id)
) tabela
JOIN gsbm_team t ON tabela.team_id = t.id
GROUP BY team_id
ORDER BY points DESC, goals_diff DESC, goals_scored DESC";

        $stmt = $this->entityManager->getConnection()->prepare($sql);
        $stmt->bindValue('1', $tournamentStage->getId());
        $stmt->bindValue('2', $tournamentStage->getId());
        $stmt->execute();
        $all = $stmt->fetchAll();

        return $all;
    }
}
