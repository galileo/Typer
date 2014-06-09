<?php

namespace Galileo\SimpleBet\MainBundle\Hydrator;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use PDO;

class BetStatsHydrator extends AbstractHydrator
{
    protected function hydrateAllData()
    {
        $result = array();
        $cache  = array();
        foreach($this->_stmt->fetchAll(AbstractQuery::HYDRATE_OBJECT) as $row) {
            $this->hydrateRowData($row, $cache, $result);
        }

        return $result;
    }

    protected function hydrateRowData(array $row, array &$cache, array &$result)
    {

        die();
        if(count($row) == 0) {
            return false;
        }

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

        $result[$id] = $value;
    }
}