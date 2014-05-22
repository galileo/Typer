<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Symfony\Component\HttpFoundation\Response;

class TournamentController
{
//    protected $tournamentRepository;
//
//    function __construct($tournamentRepository)
//    {
//        $this->tournamentRepository = $tournamentRepository;
//    }


    public function homeAction()
    {
//        /** @var Tournament $tournament */
//        $tournament = $this->tournamentRepository->find($id);
//        /** @var TournamentStage $tournamentStage */
//        foreach ($tournament->getTournamentStages() as $tournamentStage) {
//            /** @var Game $game */
//            foreach ($tournamentStage->getGames() as $game) {
//                $games[] = $game;
//            }
//        }
//
//        return $this->render('GalileoSimpleBetModelBundle:Default:index.html.twig', array('games' => $games));
        return new Response('Suuper');
    }

    public function listAction($tournamentId)
    {
        return new Response("This is $tournamentId id.");
    }
} 