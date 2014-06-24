<?php

namespace Galileo\SimpleBet\MainBundle\Service\Provider;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Galileo\SimpleBet\ModelBundle\Entity\Player;

class TodayPointsProvider implements PointsProviderInterface
{

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * {@inheritdoc}
     */
    public function playerPoints(Player $player)
    {
        $sql = "SELECT IF(SUM(pointsEarned) IS NOT NULL, SUM(pointsEarned), 0) points FROM gsbm_bet b
JOIN gsbm_game g ON g.id = b.game_id
WHERE date(g.date) = curdate()
AND b.player_id = ?
";

        $stmt = $this->entityManager->getConnection()->prepare($sql);
        $stmt->bindValue('1', $player->getId());
        $stmt->execute();
        $row = $stmt->fetch();

        return $row['points'];
    }
}