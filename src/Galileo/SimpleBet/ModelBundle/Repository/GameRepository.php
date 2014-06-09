<?php

namespace Galileo\SimpleBet\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;

class GameRepository extends EntityRepository
{
    /**
     * @param Tournament|integer $tournament
     *
     * @return Game[]
     */
    public function tournamentGames($tournament)
    {
        $games = $this->getEntityManager()
                      ->createQuery(
                          'SELECT g
                          FROM GalileoSimpleBetModelBundle:Game g
                          JOIN g.tournamentStage ts
                          WHERE ts.tournament = ?1
                          ORDER BY g.date ASC
                          '
                      )
                      ->setParameter(1, $tournament)
//                      ->setMaxResults(5)
                      ->getResult();

        return $games;
    }
} 