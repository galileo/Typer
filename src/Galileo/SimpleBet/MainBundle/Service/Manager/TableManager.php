<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;

class TableManager implements TableManagerInterface
{

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
        $sql = "SELECT t.*, points
FROM (
(     SELECT  g.home_team_id team_id,
          SUM(IF(s.home > s.away, 3, IF(s.home = s.away, 1, 0))) points
      FROM gsbm_game g
      LEFT JOIN gsbm_score s ON s.id = g.score_id
      WHERE tournament_stage_id = 5
      GROUP BY g.home_team_id)
UNION(
      SELECT g.away_team_id team_id,
          SUM(IF(s.home < s.away, 3, IF(s.home = s.away, 1, 0))) points
      FROM gsbm_game g
      LEFT JOIN gsbm_score s ON s.id = g.score_id
      WHERE tournament_stage_id = 5
      GROUP BY g.away_team_id)
) tabela
JOIN gsbm_team t ON tabela.team_id = t.id
GROUP BY team_id ORDER BY points DESC
"
    }
}