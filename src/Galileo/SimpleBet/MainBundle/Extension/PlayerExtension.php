<?php

namespace Galileo\SimpleBet\MainBundle\Extension;

use Galileo\SimpleBet\ModelBundle\Entity\Player;

class PlayerExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('display_name', array($this, 'playerDisplayName'))
        );
    }

    public function playerDisplayName(Player $player)
    {
        $displayName = $player->getDisplayName();
        if (null === $displayName) {
            $lastName = $player->getLastName();
            $displayName = sprintf('%s %s.', $player->getFirstName(), $lastName[0]);
        }

        return $displayName;
    }

    public function getName()
    {
        return 'gsbm_player_extension';
    }
}