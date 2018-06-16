<?php

namespace Galileo\SimpleBet\MainBundle\Service\Comparer;

use Galileo\SimpleBet\ModelBundle\Entity\Score;

class GoalDifferencesComparer implements ScoreCompareInterface
{
    public function compare(Score $gameScore, Score $betScore)
    {
        $homeDiff = $gameScore->getAway() - $betScore->getAway();
        $awayDiff = $gameScore->getHome() - $betScore->getHome();

        return $homeDiff - $awayDiff;
    }
}
