<?php

namespace Galileo\SimpleBet\MainBundle\Twig;

use Galileo\SimpleBet\ModelBundle\Entity\Score;

class ScoreTwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('score_one_x_two', array($this, 'process1X2')),
        );
    }

    public function process1X2(Score $score)
    {
        if ($score->getHome() > $score->getAway()) {
            return "1";
        } elseif ($score->getHome() == $score->getAway()) {
            return "X";
        }

        return "2";
    }

    public function getName()
    {
        return 'gsbm_score_extension';
    }
}
