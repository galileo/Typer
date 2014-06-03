<?php
namespace Galileo\SimpleBet\MainBundle\Service\Manager;

interface GameManagerInterface
{
    /**
     * @param $gameId
     *
     * @return object
     *
     * @throws \Symfony\Component\Translation\Exception\NotFoundResourceException
     */
    public function findGameOrFail($gameId);
}