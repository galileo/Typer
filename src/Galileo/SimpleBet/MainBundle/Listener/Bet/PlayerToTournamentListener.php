<?php

namespace Galileo\SimpleBet\MainBundle\Listener\Bet;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Galileo\SimpleBet\ModelBundle\Entity\Bet;

class PlayerToTournamentListener
{
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Bet) {
            $this->updateBetChangAble($entity);
        }
    }

    protected function updateBetChangAble(Bet $entity)
    {
        $entity->setIsChangeAble(false);
    }
}
