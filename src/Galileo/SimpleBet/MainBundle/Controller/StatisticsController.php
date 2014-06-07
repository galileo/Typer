<?php

namespace Galileo\SimpleBet\MainBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class StatisticsController {

    /**
     * @var EntityRepository
     */
    protected $tournamentRepository;

    /**
     * @var EngineInterface
     */
    protected $templating;

    public function __construct(EntityRepository $tournamentRepository, EngineInterface $templating)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->templating = $templating;
    }

    public function getBetAccuracyStatsView($tournamentId)
    {
        $perfectCount = 1;
        $goodCount = 2;
        $badCount = 4;

        $all = $perfectCount + $goodCount + $badCount;

        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:Statistics:viewBetAccuracy.html.twig', array(
                'perfect' => $perfectCount,
                'good' => $goodCount,
                'bad' => $badCount,
                'all' => $all
            ));
    }

} 