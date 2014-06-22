<?php

namespace Galileo\SimpleBet\ModelBundle\Repository;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\From;
use Doctrine\ORM\Query\Expr\Select;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Symfony\Component\Validator\Constraints\DateTime;

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

    public function getTournamentGames($tournament = null, $limit = null, $next = true, $orderBy = 'g.date', $orderDirection = 'DESC')
    {
        $queryBuilder = $this->getEntityManager()
                             ->createQueryBuilder();

        $queryBuilder
            ->add('select', new Select('g'))
            ->add('from', new From('GalileoSimpleBetModelBundle:Game', 'g'))
            ->orderBy($orderBy, $orderDirection);

        if ($next == true) {
            $queryBuilder->add('where', $queryBuilder->expr()->gt('g.date', '?1'));
        } else {
            $queryBuilder->add('where', $queryBuilder->expr()->lt('g.date', '?1'));
        }

        $queryBuilder->setParameter(1, new \DateTime(), Type::DATETIME);
        if ($tournament) {
            $queryBuilder->join('g.tournamentStage', 'ts');
            $queryBuilder->andWhere('ts.tournament = ?3');
            $queryBuilder->setParameter('3', $tournament);
        }
        if ($limit) {
            $queryBuilder->setMaxResults($limit);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param Tournament|integer $tournament
     *
     * @return Game[]
     */
    public function todayGames($tournament)
    {
        $dateTime = new \DateTime();
        $tomorrow = new \DateTime();
        $tomorrow->add(new \DateInterval('PT24H'));

        $games = $this->getEntityManager()
                      ->createQuery(
                          'SELECT g
                          FROM GalileoSimpleBetModelBundle:Game g
                          JOIN g.tournamentStage ts
                          WHERE ts.tournament = ?1
                          AND g.date > ?2
                          AND g.date < ?3
                          ORDER BY g.date ASC
                          '
                      )
                      ->setParameter(1, $tournament)
                      ->setParameter(2, $dateTime)
                      ->setParameter(3, $tomorrow)
                      ->getResult();

        return $games;
    }
} 