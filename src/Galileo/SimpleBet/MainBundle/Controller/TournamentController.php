<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

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
     * @var EntityRepository
     */
    protected $gameRepository;


    function __construct(EntityRepository $tournamentRepository, EntityRepository $gameRepository, EngineInterface $templating)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->templating = $templating;
        $this->gameRepository = $gameRepository;
    }

    public function homeAction()
    {
        $tournaments = $this->tournamentRepository->findAll();

        return $this->templating->renderResponse(
            'GalileoSimpleBetMainBundle:Tournament:home.html.twig', array(
                'tournaments' => $tournaments
            )
        );
    }

    public function listAction($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:show.html.twig',
            array('tournament' => $tournament)
        );
    }
    
    public function gameBetsAction($tournamentId, $gameId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);
        $game = $this->gameRepository->find($gameId);

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Tournament:showWithBets.html.twig',
            array(
                'tournament' => $tournament,
                'game' => $game,
            )
        );
    }
} 