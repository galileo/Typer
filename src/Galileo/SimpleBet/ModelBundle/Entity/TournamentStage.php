<?php

namespace Galileo\SimpleBet\ModelBundle\Entity;

class TournamentStage
{

    protected $id;
    protected $name;
    protected $type; // Group Stage, Cup stage etc
    protected $games;
    protected $tournament;

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->games;
    }


}