<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

class Tournament
{
    protected $id;
    protected $name;
    protected $tournamentStages;

    /**
     * @return mixed
     */
    public function getTournamentStages()
    {
        return $this->tournamentStages;
    }


}