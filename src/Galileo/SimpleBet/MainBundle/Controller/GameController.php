<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GameController
{


    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    protected $templating;

    function __construct(EntityManager $entityManager, EngineInterface $templating)
    {
        $this->entityManager = $entityManager;
        $this->templating = $templating;

        $this->gameRepository = $entityManager->getRepository('GalileoSimpleBetModelBundle:Game');
    }

    public function betsAction($gameId)
    {
        $game = $this->getGameOrFail($gameId);

        $this->templating->renderResponse('GalileoSimpleBetModelBundle::Game/betsAction.html.twig',
            array('game' => $game)
        );
    }

    /**
     * @param $gameId
     *
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    protected function getGameOrFail($gameId)
    {
        $game = $this->gameRepository->find($gameId);

        if (!$game) {
            throw new HttpException(404, 'Game not found.');
        }

        return $game;
    }
} 