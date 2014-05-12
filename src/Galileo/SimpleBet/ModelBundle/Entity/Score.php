<?php
namespace Galileo\SimpleBet\ModelBundle\Entity;

class Score
{
    protected $id;
    protected $score;
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
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return mixed
     */
    public function getScoreType()
    {
        return $this->scoreType;
    } // Simple type 2:1, Football type 2:1 (0:1), Tennis Type: 7:6 4:6 6:1 etc
} 