<?php


namespace Galileo\SimpleBet\MainBundle\Statistics;


class BetStatistics
{
    /**
     * @var int
     */
    protected $perfect;

    /**
     * @var int
     */
    protected $good;

    /**
     * @var int
     */
    protected $bad;

    /**
     * @return int
     */
    public function getBad()
    {
        return $this->bad;
    }

    /**
     * @param int $bad
     *
     * @return $this
     */
    public function setBad($bad)
    {
        $this->bad = $bad;

        return $this;
    }

    /**
     * @return int
     */
    public function getGood()
    {
        return $this->good;
    }

    /**
     * @param int $good
     *
     * @return $this
     */
    public function setGood($good)
    {
        $this->good = $good;

        return $this;
    }

    /**
     * @return int
     */
    public function getPerfect()
    {
        return $this->perfect;
    }

    /**
     * @param int $perfect
     *
     * @return $this
     */
    public function setPerfect($perfect)
    {
        $this->perfect = $perfect;

        return $this;
    }


    public function getAll()
    {
        return $this->bad + $this->good + $this->perfect;
    }

    public function increaseBad()
    {
        ++$this->bad;
    }

    public function increasePerfect()
    {
        ++$this->perfect;
    }

    public function increaseGood()
    {
        ++$this->good;
    }

    public function getPerfectPercentage()
    {
        if ($this->getAll()) {
            return round($this->perfect / $this->getAll() * 100, 0);
        }

        return 0;
    }

    public function getGoodPercentage()
    {
        if ($this->getAll()) {
            return round($this->good / $this->getAll() * 100, 0);
        }

        return 0;
    }

    public function getBadPercentage()
    {
        if ($this->getAll()) {
            return 100 - $this->getGoodPercentage() - $this->getPerfectPercentage();
        }
        return 0;
    }

} 