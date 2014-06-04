<?php

namespace Galileo\SimpleBet\MainBundle\Service\Manager;

use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\PlayerToTournament;

class TournamentManager {


    /**
     * @var TournamentProvider
     */
    protected $tournamentProvider;

    public function __construct(TournamentProvider $tournamentProvider) {

        $this->tournamentProvider = $tournamentProvider;
    }

    /**
     * @param Player $player
     *
     * @return PlayerToTournament
     */
    public function joinPlayer(Player $player)
    {
        $tournament = $this->tournamentProvider->getTournament();
        $playerToTournament = $this->playerToTournamentManager->bind($tournament, $player);

        $this->playerToTournamentManager->save($playerToTournament);
        $this->playerToTournamentManager->update($playerToTournament);

        return $playerToTournament;
    }
} 