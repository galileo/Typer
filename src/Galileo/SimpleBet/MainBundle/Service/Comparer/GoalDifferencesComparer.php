<?php

namespace Galileo\SimpleBet\MainBundle\Service\Comparer;

use Galileo\SimpleBet\ModelBundle\Entity\Score;

class GoalDifferencesComparer implements ScoreCompareInterface
{
    public function compare(Score $gameScore, Score $betScore)
    {
        $homeDiff = abs($gameScore->getAway() - $betScore->getAway());
        $awayDiff = abs($gameScore->getHome() - $betScore->getHome());

        return $homeDiff + $awayDiff;
    }
}
