<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;

interface TableManagerInterface {

    public function generateHomeTable(TournamentStage $tournamentStage);

    public function generateAwayTable(TournamentStage $tournamentStage);

    public function generateTable(TournamentStage $tournamentStage);
}