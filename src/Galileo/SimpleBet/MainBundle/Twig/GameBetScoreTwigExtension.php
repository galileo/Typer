<?php

namespace Galileo\SimpleBet\MainBundle\Twig;

use Galileo\SimpleBet\MainBundle\Service\Comparer\ScoreCompareInterface;
use Galileo\SimpleBet\MainBundle\Service\Comparer\SimpleScoreCompare;
use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Score;

class GameBetScoreTwigExtension extends \Twig_Extension
{
    protected $labelTemplate = '<span class="label label-%s" title="%s">%s</span>';

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('game_bet', array($this, 'score')),
            new \Twig_SimpleFilter('bet_point', array($this, 'points'))
        );
    }

    public function score(Score $gameScore = null,  Bet $bet = null)
    {
        if (null === $bet) {
            if (null == $gameScore)
            {
                return '?:?';
            }
            return $gameScore;
        }

        if (null === $gameScore) {
            return $bet->getScore();
        }

        $compare = new SimpleScoreCompare();

        $template = $this->labelTemplate;

        switch ($compare->compare($gameScore, $bet->getScore())) {
            case ScoreCompareInterface::PERFECT:
                $label = 'success';
                break;
            case ScoreCompareInterface::GOOD:
                $label = 'warning';
                break;
            default:
                $label = 'danger';
        }

        return sprintf($template, $label, $bet->getScore(), $gameScore);
    }

    public function points(Bet $bet)
    {
        switch ($bet->getPointsEarned()){
            case 3:
                $label = 'success';
                break;
            case 1:
                $label = 'warning';
                break;
            default:
                return '';
        }

        return sprintf($this->labelTemplate, $label, $bet->getPointsEarned(), $bet->getPointsEarned());
    }


    public function getName()
    {
        return 'gsbm_game_bet_extension';
    }
}