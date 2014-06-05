<?php


namespace Galileo\SimpleBet\ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User;
use Galileo\SimpleBet\ModelBundle\Providers\BetStats;

class Player extends User
{
    protected $id;
    protected $displayName;
    protected $firstName;
    protected $lastName;

    protected $tournaments;

    protected $bets;

    /**
     * @var BetStats
     */
    protected $betStats;

    function __construct()
    {
        $this->bets = new ArrayCollection();
        parent::__construct();
    }


    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
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
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return ArrayCollection|Bet[]
     */
    public function getBets()
    {
        return $this->bets;
    }
}