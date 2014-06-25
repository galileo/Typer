<?php

namespace Galileo\SimpleBet\MainBundle\Service\Comparer;

use Galileo\SimpleBet\ModelBundle\Entity\Score;

interface ScoreCompareInterface
{
    const PERFECT = '1';
    const GOOD = '0';
    const BAD = '-1';

    /**
     * @param  Score $gameScore
     * @param  Score $betScore
     * @return mixed
     */
    public function compare(Score $gameScore, Score $betScore);
}
