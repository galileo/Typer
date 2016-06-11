<?php

namespace Galileo\SimpleBet\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Entity\Bet;

class BetRepository extends EntityRepository
{

    /**
     * @return Bet[]
     */
    public function findTournamentBets($tournamentId)
    {
        $tournamentBets = $this->getEntityManager()
            ->createQuery(
                'SELECT b
                FROM GalileoSimpleBetModelBundle:Bet b
                JOIN b.game g
                JOIN g.tournamentStage ts
                WHERE ts.tournament = ?1'
            )
            ->setParameter(1, $tournamentId)
            ->getResult();

        return $tournamentBets;
    }

    public function findPlayerTournamentBets($player, $tournament)
    {
        $bets = $this->getEntityManager()
            ->createQuery(
                'SELECT b
                FROM GalileoSimpleBetModelBundle:Bet b
                JOIN b.game g
                JOIN g.tournamentStage ts
                WHERE ts.tournament = ?1
                AND b.player = ?2
                '
            )
            ->setParameter(1, $tournament)
            ->setParameter(2, $player)
            ->getResult();

        return $bets;
    }

    public function bestBettedGames($tournamentId, $limit)
    {
        return $this->getSuper($tournamentId, $limit, 'DESC');
    }

    public function worstBettedGames($tournamentId, $limit)
    {
        return $this->getSuper($tournamentId, $limit, 'ASC');
    }

    /**
     * @param $tournamentId
     * @param $limit
     * @return mixed
     */
    protected function getSuper($tournamentId, $limit, $super)
    {
        $sql = 'SELECT b, g, h, a,
                  (COUNT(b.id) * 3) possiblePoints,
                  SUM(b.pointsEarned) pointsEarned,
                  SUM(b.pointsEarned)/(COUNT(b.id) * 3) * 100 efficiency
                FROM GalileoSimpleBetModelBundle:Bet b
                  JOIN b.game g
                  JOIN g.homeTeam h
                  JOIN g.awayTeam a
                  JOIN g.tournamentStage ts
                WHERE ts.tournament = ?1
                  AND g.isPlayed = ?2
                GROUP BY g.id
                ORDER BY efficiency '. $super;

        $objects = $this->getEntityManager()
            ->createQuery($sql)
            ->setParameter(1, $tournamentId)
            ->setParameter(2, 1)
            ->setMaxResults($limit)
            ->getResult();

        return $objects;
    }
}
