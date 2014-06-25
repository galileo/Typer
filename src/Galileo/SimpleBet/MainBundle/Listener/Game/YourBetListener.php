<?php

namespace Galileo\SimpleBet\MainBundle\Listener\Game;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Galileo\SimpleBet\MainBundle\Service\Manager\BetManagerInterface;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Symfony\Component\DependencyInjection\ContainerInterface;

class YourBetListener
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var BetManagerInterface
     */
    protected $betManager;

    /**
     * @var Player
     */
    protected $currentPlayer;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function initialize()
    {
        $this->betManager = $this->container->get('gsbm.manager.bet');
        $this->currentPlayer = $this->container->get('gsbm.manager.current_player')->getCurrentPlayer();
    }

    public function postLoad(LifecycleEventArgs $event)
    {
        $game = $event->getEntity();

        if ($game instanceof Game) {
            $this->initialize();

            if (!$this->currentPlayer instanceof Player) {
                return;
            }

            $bet = $this->betManager->findBet($this->currentPlayer, $game);
            if (null !== $bet) {
                $game->setYourBet($bet);
            }
        }

    }
}
