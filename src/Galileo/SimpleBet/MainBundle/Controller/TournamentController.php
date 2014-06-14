<?php

namespace Galileo\SimpleBet\MainBundle\Controller;

use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;
use Galileo\SimpleBet\ModelBundle\Repository\GameRepository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TournamentController
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var EntityRepository
     */
    protected $tournamentRepository;

    /**
     * @var GameRepository
     */
    protected $gameRepository;


    function __construct(EntityRepository $tournamentRepository, GameRepository $gameRepository, EngineInterface $templating)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->templating = $templating;
        $this->gameRepository = $gameRepository;
    }

    public function homeAction()
    {
        $tournaments = $this->tournamentRepository->findBy(array(), array('id' => 'DESC'));

        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Tournament:home.html.twig', array(
                'tournaments' => $tournaments
            )
        );
    }

    public function listAction($tournamentId)
    {
        $tournament = $this->findOrFail($tournamentId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:view.html.twig',
            array('tournament' => $tournament)
        );
    }

    public function ruleAction($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:viewRules.html.twig',
            array('tournament' => $tournament)
        );
    }

    public function gameBetsAction($tournamentId, $gameId)
    {
        $tournament = $this->findOrFail($tournamentId);
        $game = $this->gameRepository->find($gameId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:viewWithBets.html.twig',
            array(
                'tournament' => $tournament,
                'game'       => $game,
            )
        );
    }

    public function currentGamesAction($tournamentId)
    {
        $tournament = $this->findOrFail($tournamentId);
        $games = $this->gameRepository->tournamentGames($tournament);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:currentGames.html.twig', array(
                'tournament' => $tournament,
                'games' => $games
            ));
    }

    /**
     * @param $tournamentId
     * @return null|object
     */
    protected function findOrFail($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);

        if (null === $tournament)
        {
            throw new NotFoundHttpException('Tournament not found.');
        }

        return $tournament;
    }
} 