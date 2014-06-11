<?php


namespace Galileo\SimpleBet\MainBundle\Listener\Game;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Galileo\SimpleBet\MainBundle\Service\Manager\BetManagerInterface;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CalculateBetPointsListener
{

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }

    public function initialize()
    {
        $this->betManager = $this->container->get('gsbm.manager.bet');
        $this->currentPlayer = $this->container->get('gsbm.manager.current_player')->getCurrentPlayer();
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $game = $event->getEntity();

        if ($game instanceof Game) {
            $this->calculateGame($game);
        }
    }

    private function calculateGame(Game $game)
    {
        foreach ($game->getBets() as $bet)
        {
            var_dump($bet);

        }
    }
} 