<?php

namespace Galileo\SimpleBet\ModelBundle\Entity;

use Galileo\SimpleBet\MainBundle\Service\Comparer\GoalDifferencesComparer;
use Galileo\SimpleBet\MainBundle\Service\Comparer\ScoreCompareInterface;
use Galileo\SimpleBet\MainBundle\Service\Comparer\SimpleScoreComparer;

class Bet
{
    protected $id;

    protected $game;

    /**
     * @var Score
     */
    protected $score;

    protected $player;

    protected $isActive;

    protected $pointsEarned;

    protected $smallPoints;

    protected $isChangeAble = true;

    public function __construct()
    {
        $this->smallPoints = 0;
    }

    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return mixed
     */
    public function getPointsEarned()
    {
        return $this->pointsEarned;
    }

    /**
     * @param mixed $pointsEarned
     */
    public function setPointsEarned($pointsEarned)
    {
        $this->pointsEarned = $pointsEarned;
    }

    /**
     * @return Score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return boolean
     */
    public function isChangeAble()
    {
        return $this->isChangeAble;
    }

    /**
     * @param boolean $isChangeAble
     */
    public function setIsChangeAble($isChangeAble)
    {
        $this->isChangeAble = $isChangeAble;
    }

    public function smallPoints()
    {
        return $this->smallPoints;
    }

    public function calculateScore(Game $game)
    {
        if (!$game->getIsPlayed()) {
            $this->smallPoints = 0;
            $this->pointsEarned = 0;

            return;
        }

        $goalDifferencesComparer = new GoalDifferencesComparer();
        $simpleScoreComparer = new SimpleScoreComparer();

        $this->smallPoints = $goalDifferencesComparer->compare($game->getScore(), $this->getScore());

        $compareValue = $simpleScoreComparer->compare($game->getScore(), $this->getScore());

        switch ($compareValue) {
            case ScoreCompareInterface::PERFECT:
                $points = 3;
                break;
            case ScoreCompareInterface::GOOD:
                $points = 1;
                break;
            default:
                $points = 0;
        }

        $this->pointsEarned = $points;
    }

    public function __toString()
    {
        return $this->score ? $this->score->getHome() . ':' . $this->score->getAway() : '-:-';
    }

}
