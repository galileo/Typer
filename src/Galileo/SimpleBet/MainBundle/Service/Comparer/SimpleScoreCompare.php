<?php


namespace Galileo\SimpleBet\MainBundle\Service\Comparer;


use Galileo\SimpleBet\ModelBundle\Entity\Score;

class SimpleScoreCompare implements ScoreCompareInterface
{

    /**
     * @var Score
     */
    protected $gameScore;

    /**
     * @var Score
     */
    protected $betScore;

    /**
     * @param Score $gameScore
     * @param Score $betScore
     * @return int
     */
    public function compare(Score $gameScore, Score $betScore)
    {
        $this->gameScore = $gameScore;
        $this->betScore = $betScore;

        if ($this->isPerfect()) {
            return ScoreCompareInterface::PERFECT;
        } else if ($this->isGood()) {
            return ScoreCompareInterface::GOOD;
        }

        return ScoreCompareInterface::BAD;
    }

    protected function isPerfect()
    {
        if ($this->betScore->getAway() == $this->gameScore->getAway() &&
            $this->betScore->getHome() == $this->gameScore->getHome ()
        ) {
            return true;
        }

        return false;
    }

    protected function isGood()
    {
        if ($this->homeWins($this->gameScore) && $this->homeWins($this->betScore)) {
            return true;
        }

        if ($this->awayWins($this->gameScore) && $this->awayWins($this->betScore)) {
            return true;
        }

        if ($this->isDraw($this->gameScore) && $this->isDraw($this->betScore)) {
            return true;
        }

        return false;
    }


    /**
     * @param Score $gameScore
     * @return bool
     */
    protected function homeWins(Score $gameScore)
    {
        if ($gameScore->getHome() > $gameScore->getAway()) {
            return true;
        }

        return false;
    }

    /**
     * @param Score $gameScore
     * @return bool
     */
    protected function awayWins(Score $gameScore)
    {
        if ($gameScore->getHome() < $gameScore->getAway()) {
            return true;
        }

        return false;
    }

    /**
     * @param Score $gameScore
     * @return bool
     */
    protected function isDraw(Score $gameScore)
    {
        if ($gameScore->getHome() == $gameScore->getAway()) {
            return true;
        }

        return false;
    }
}