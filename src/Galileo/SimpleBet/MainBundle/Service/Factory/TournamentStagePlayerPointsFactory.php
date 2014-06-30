<?php

namespace Galileo\SimpleBet\MainBundle\Service\Factory;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\MainBundle\Model\PlayerPointsModel;
use Galileo\SimpleBet\MainBundle\Utils\ArrayCollection;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;
use Galileo\SimpleBet\ModelBundle\Repository\PlayerRepository;

class TournamentStagePlayerPointsFactory
{
    /**
     * @var PlayerRepository
     */
    protected $pointRepository;

    public function __construct(PlayerRepository $pointRepository)
    {
        $this->pointRepository = $pointRepository;
    }

    /**
     * @param  TournamentStage $tournamentStage
     * @return ArrayCollection
     */
    public function buildCollection(TournamentStage $tournamentStage)
    {
        $query = $this->pointRepository->getPointsQueryBuilder();

        $query->andWhere('g.tournamentStage = :stage');
        $query->setParameter('stage', $tournamentStage);

        $query->setMaxResults($limit = 5);

        $collection = new ArrayCollection();
        foreach ($query->getQuery()->getResult() as $row) {
            $playerPoint = new PlayerPointsModel(
                $row['player'],
                $row['bets'],
                $row['points'],
                0
            );

            $collection->add($playerPoint);
        }

        return $collection;
    }
}
