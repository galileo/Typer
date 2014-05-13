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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTournament()
    {
        return $this->tournament;
    }


}