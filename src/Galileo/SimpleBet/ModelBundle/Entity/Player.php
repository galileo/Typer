<?php


namespace Galileo\SimpleBet\ModelBundle\Entity;

use FOS\UserBundle\Model\User;

class Player extends User
{
    protected $id;
    protected $displayName;
    protected $firstName;
    protected $lastName;
}