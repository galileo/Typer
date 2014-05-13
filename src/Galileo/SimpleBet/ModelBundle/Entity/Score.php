<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

class Score
{
    protected $id;
    protected $home;
    protected $away;
    protected $scoreType;

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
    public function getScoreType()
    {
        return $this->scoreType;
    }

    /**
     * @return mixed
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * @return mixed
     */
    public function getHome()
    {
        return $this->home;
    } // Simple type 2:1, Football type 2:1 (0:1), Tennis Type: 7:6 4:6 6:1 etc


} 