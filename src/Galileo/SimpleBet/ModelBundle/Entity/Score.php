<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

class Score
{
    protected $id;
    protected $home;
    protected $away;
    protected $scoreType;

    public function __toString()
    {
        return $this->home . ':' . $this->away;
    }

    /**
     * @return mixed
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * @param mixed $away
     *
     * @return $this
     */
    public function setAway($away)
    {
        $this->away = $away;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * @param mixed $home
     *
     * @return $this
     */
    public function setHome($home)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getScoreType()
    {
        return $this->scoreType;
    }

    /**
     * @param mixed $scoreType
     */
    public function setScoreType($scoreType)
    {
        $this->scoreType = $scoreType;
    }

}
