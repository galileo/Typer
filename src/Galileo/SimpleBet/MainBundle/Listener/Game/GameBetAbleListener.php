<?php


namespace Galileo\SimpleBet\MainBundle\Listener\Game;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Galileo\SimpleBet\MainBundle\Service\Manager\GameManagerInterface;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GameBetAbleListener
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var GameManagerInterface
     */
    protected $gameManager;

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }


    protected function initialize()
    {
        $this->gameManager = $this->container->get('gsbm.manager.game');
    }

    public function postLoad(LifecycleEventArgs $event)
    {
        $game = $event->getEntity();

        if ($game instanceof Game) {
            $this->recognizeBetAbility($game);
        }
    }

    /**
     * @param Game $game
     */
    protected function recognizeBetAbility(Game $game)
    {
        $this->initialize();
        if ($this->gameManager->isBettingAvailable($game)) {
            $game->markAsBetAble();
        }

        if ($this->gameManager->isAvailableForPlayer($game)) {
            $game->markAsAvailableForCurrentPlayer();
        }
    }

} 