<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;

interface PlayerToTournamentManagerInterface {


    /**
     * @param Player $player
     * @param Tournament $tournament
     * @return \Galileo\SimpleBet\ModelBundle\Entity\PlayerToTournament
     */
    public function joinPlayerIntoTournament(Player $player, Tournament $tournament);

    /**
     * @param Player $player
     * @param Tournament $tournament
     * @return boolean
     */
    public function checkPlayerInTournament(Player $player, Tournament $tournament);
} 