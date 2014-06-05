<?php


namespace Galileo\SimpleBet\ModelBundle\Entity;


class PlayerToTournament
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Galileo\SimpleBet\ModelBundle\Entity\Player
     */
    protected $player;

    /**
     * @var \Galileo\SimpleBet\ModelBundle\Entity\Tournament
     */
    protected $tournament;

    /**
     * @var boolean
     */
    protected $isActive;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return \Galileo\SimpleBet\ModelBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param \Galileo\SimpleBet\ModelBundle\Entity\Player $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return \Galileo\SimpleBet\ModelBundle\Entity\Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * @param \Galileo\SimpleBet\ModelBundle\Entity\Tournament $tournament
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;
    }

}