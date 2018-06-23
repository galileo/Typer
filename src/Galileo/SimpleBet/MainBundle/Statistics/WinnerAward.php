<?php

namespace Galileo\SimpleBet\MainBundle\Statistics;

use Galileo\SimpleBet\ModelBundle\Entity\PlayerToTournament;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;

class WinnerAward
{
    private $expectedPrice;
    private $totalPaid;

    public function __construct($expectedPrice, $totalPaid)
    {
        $this->expectedPrice = $expectedPrice;
        $this->totalPaid = $totalPaid;
    }

    public function expectedPrice()
    {
        return $this->expectedPrice;
    }

    public function totalPaid()
    {
        return $this->totalPaid;
    }

    public function first()
    {
        return round($this->totalPaid * 0.5, 2);
    }

    public function second()
    {
        return round($this->totalPaid * 0.35, 2);
    }

    public function third()
    {
        return round($this->totalPaid * 0.15, 2);
    }

    public static function fromTournament(Tournament $tournament)
    {
        $allCount = $tournament->getPlayerToTournament()->count();
        $paidCount = $tournament->getPlayerToTournament()->filter(function (PlayerToTournament $playerToTournament) {
            return $playerToTournament->isPaid();
        })->count();

        return new WinnerAward($allCount * 20, $paidCount * 20);
    }
}
