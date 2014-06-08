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
}