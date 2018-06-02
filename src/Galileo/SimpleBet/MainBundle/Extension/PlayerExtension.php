<?php

namespace Galileo\SimpleBet\MainBundle\Extension;

use Galileo\SimpleBet\ModelBundle\Entity\Player;

class PlayerExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('display_name', array($this, 'playerDisplayName')),
            new \Twig_SimpleFilter('championship', array($this, 'championship'))
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

    public function championship(Player $player)
    {
          return str_repeat('<i class="text-warning fa fa-star-o" aria-hidden="true"></i>', $player->getChampionship());
    }

    public function getName()
    {
        return 'gsbm_player_extension';
    }
}
