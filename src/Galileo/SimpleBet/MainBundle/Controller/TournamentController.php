<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class TournamentController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    protected $templating;


    protected $tournamentRepository;


    function __construct(EntityManager $entityManager, EngineInterface $templating)
    {
        $this->entityManager = $entityManager;

        $this->tournamentRepository = $this->entityManager->getRepository('GalileoSimpleBetModelBundle:Tournament');
        $this->playerRepository = $this->entityManager->getRepository('GalileoSimpleBetModelBundle:Player');
        $this->gameRepository = $this->entityManager->getRepository('GalileoSimpleBetModelBundle:Game');

        $this->templating = $templating;
    }

    public function homeAction()
    {
        $tournaments = $this->tournamentRepository->findAll();

        $bestPlayers = $this->playerRepository->findBestPlayers();

        return $this->templating->renderResponse(
            '@GalileoSimpleBetMain/Torunament/home.html.twig', array(
                'tournaments' => $tournaments,
                'bestPlayers' => $bestPlayers
            )
        );
    }

    public function listAction($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);

        return $this->templating->renderResponse('@GalileoSimpleBetMain/Torunament/show.html.twig',
            array('tournament' => $tournament)
        );
    }
    
    public function gameBetsAction($tournamentId, $gameId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);
        $game = $this->gameRepository->find($gameId);

        return $this->templating->renderResponse('@GalileoSimpleBetMain/Torunament/showWithBets.html.twig',
            array(
                'tournament' => $tournament,
                'game' => $game,
            )
        );
    }
} 