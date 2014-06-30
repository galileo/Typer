<?php

namespace Galileo\SimpleBet\ModelBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Galileo\SimpleBet\ModelBundle\Providers\BetStats;

class PlayerRepository extends EntityRepository
{

    /**
     * @return ArrayCollection|Player[]
     */
    public function findBestPlayers()
    {
        $playersAndBetStats = $this->getEntityManager()
            ->createQuery(
                'SELECT p, COUNT(b.id) totalBets,
                SUM(b.pointsEarned) totalPoints,
                COUNT(b.id) / SUM(b.pointsEarned) pointRate
                FROM GalileoSimpleBetModelBundle:Player p
                JOIN p.bets b
                WHERE b.player = p.id
                GROUP BY p.id ORDER BY totalPoints DESC, pointRate DESC'
            )
            ->getResult('BetStatsHydrator');

        return $playersAndBetStats;
    }

    public function tournamentPlayerStats(Tournament $tournament, $limit = null)
    {

        $playersAndBetStats = $this->getEntityManager()
            ->createQuery(
                'SELECT p, COUNT(b.id) totalBets,
                SUM(b.pointsEarned) totalPoints,
                COUNT(b.id) / SUM(b.pointsEarned) pointRate
                FROM GalileoSimpleBetModelBundle:Player p
                LEFT JOIN p.bets b
                JOIN b.game g
                JOIN g.tournamentStage ts

                WHERE ts.tournament = ?1
                GROUP BY p.id ORDER BY totalPoints DESC, pointRate DESC
                '
            )
            ->setParameter(1, $tournament)
            ->setMaxResults($limit)
            ->getResult('BetStatsHydrator');

        return $playersAndBetStats;
    }

    /**
     * @return QueryBuilder
     */
    public function getPointsQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->addSelect('p player')
            ->addSelect('COUNT(b.id) bets')
            ->addSelect('SUM(b.pointsEarned) points')
            ->from('GalileoSimpleBetModelBundle:Player', 'p')
            ->leftJoin('p.bets', 'b')
            ->join('b.game', 'g')
            ->addOrderBy('points', 'DESC')
            ->addGroupBy('p.id')
        ;

        return $queryBuilder;
    }
}
