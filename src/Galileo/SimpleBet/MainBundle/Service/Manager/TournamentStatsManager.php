<?php

namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\ModelBundle\Entity\Tournament;

class TournamentStatsManager
{

    public function __construct()
    {

    }

    public function makeStats(Tournament $tournament)
    {
        $tournamentStats = new TournamentStats();
//        $this->tournamentRepository->
    }
}
