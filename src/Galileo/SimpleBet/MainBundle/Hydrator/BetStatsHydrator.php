<?php

namespace Galileo\SimpleBet\MainBundle\Hydrator;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use Doctrine\ORM\Internal\Hydration\ObjectHydrator;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Providers\BetStats;
use PDO;

class BetStatsHydrator extends AbstractHydrator
{
    protected function hydrateAllData()
    {
        $result = array();
        $cache  = array();
        foreach($this->_stmt->fetchAll(PDO::FETCH_BOTH) as $row) {
            $this->hydrateRowData($row, $cache, $result);
        }

        return $result;
    }

    protected function hydrateRowData(array $row, array &$cache, array &$result)
    {
        if(count($row) == 0) {
            return false;
        }

        $player = new Player();
        $player->setId($row[16]);
        $player->setChampionship($row[20]);
        $player->setDisplayName($row[19]);
        $player->setFirstName($row[17]);
        $player->setLastName($row[18]);

        $newBetStats = new BetStats($player);
        $newBetStats->setTotalBets($row[21]);
        $newBetStats->setTotalPoints($row[22]);


        $result[$row[0]] = $newBetStats;

        $keys = array_keys($row);

        // Assume first column is id field
        $id = $row[$keys[0]];

        $value = false;

        if(count($row) == 2) {
            // If only one more field assume that this is the value field
            $value = $row[$keys[1]];
        } else {
            // Remove ID field and add remaining fields as value array
            array_shift($row);
            $value = $row;
        }

    }
}