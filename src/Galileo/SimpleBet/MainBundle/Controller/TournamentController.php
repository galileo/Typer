<?php

namespace Galileo\SimpleBet\MainBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\MainBundle\Statistics\WinnerAward;
use Galileo\SimpleBet\ModelBundle\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
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

    public function __construct(EntityRepository $tournamentRepository, GameRepository $gameRepository, EngineInterface $templating)
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
                'currentGame' => $game,
            )
        );
    }

    public function winnerAward($tournamentId) {
        $tournament = $this->findOrFail($tournamentId);

        $winningPrice = WinnerAward::fromTournament($tournament);

        return $this->templating->renderResponse('@GalileoSimpleBetMain/Tournament/winnerAward.twig', array(
            'winnerAward' => $winningPrice
        ));
    }


    public function currentGamesAction($tournamentId)
    {
        $tournament = $this->findOrFail($tournamentId);
        $games = $this->gameRepository->tournamentGames($tournament);

        $previousGames = $this->gameRepository->getTournamentGames($tournament, 5, false, 'g.date', 'DESC');
        $nextGames = $this->gameRepository->getTournamentGames($tournament, 5, true, 'g.date', 'ASC');

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:currentGames.html.twig', array(
            'tournament' => $tournament,
            'games' => $games,
            'previous' => $previousGames,
            'next' => $nextGames,
        ));
    }

    public function standingsAction($tournamentId)
    {
        $tournament = $this->findOrFail($tournamentId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:playerStandings.html.twig', array(
            'tournament' => $tournament,
        ));
    }

    public function todayGamesAction($tournamentId)
    {
        $tournament = $this->findOrFail($tournamentId);
        $games = $this->gameRepository->todayGames($tournament);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:todayGames.html.twig', array(
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

        if (null === $tournament) {
            throw new NotFoundHttpException('Tournament not found.');
        }

        return $tournament;
    }
}
