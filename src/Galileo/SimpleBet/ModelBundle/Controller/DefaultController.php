<?php

namespace Galileo\SimpleBet\ModelBundle\Controller;

use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;
use Galileo\SimpleBet\ModelBundle\Views\GameView;
use Galileo\SimpleBet\ModelBundle\Views\ScoreView;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        /** @var Tournament $tournament */
        $tournament = $this->getDoctrine()->getRepository('GalileoSimpleBetModelBundle:Tournament')->find(1);
        /** @var TournamentStage $tournamentStage */
        foreach ($tournament->getTournamentStages() as $tournamentStage)
        {
            /** @var Game $game */
            foreach ($tournamentStage->getGames() as $game)
            {
                $games[] = $game;
            }
        }

        return $this->render('GalileoSimpleBetModelBundle:Default:index.html.twig', array('games' => $games));
    }
}
