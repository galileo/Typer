<?php


namespace Galileo\SimpleBet\ModelBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
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
                                   ->getResult();

        $arrayCollection = new ArrayCollection();
        foreach ($playersAndBetStats as $playerAndBet) {
            /** @var Player $player */
            $player = $playerAndBet[0];

            $betStats = new BetStats($player);
            $betStats->setTotalBets($playerAndBet['totalBets']);
            $betStats->setTotalPoints($playerAndBet['totalPoints']);

            $arrayCollection->add($betStats);
        }

        return $arrayCollection;
    }


} 