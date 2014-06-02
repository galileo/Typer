<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Galileo\SimpleBet\ModelBundle\Entity\PlayerToTournament;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;

class PlayerToTournamentManager implements PlayerToTournamentManagerInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $playerToTournamentRepository;

    function __construct(EntityManager $entityManager, EntityRepository $playerToTournamentRepository)
    {
        $this->entityManager = $entityManager;
        $this->playerToTournamentRepository = $playerToTournamentRepository;
    }


    /**
     * @param \Galileo\SimpleBet\ModelBundle\Entity\Player $player
     * @param \Galileo\SimpleBet\ModelBundle\Entity\Tournament $tournament
     *
     * @throws \Exception
     *
     * @return \Galileo\SimpleBet\ModelBundle\Entity\PlayerToTournament
     */
    public function joinPlayerIntoTournament(Player $player, Tournament $tournament)
    {
        $playerToTournament = new PlayerToTournament($player, $tournament);

        if ($this->entityManager->contains($playerToTournament)) {
            throw new Exception('Player already in tournament.');
        }

        try {
            $this->entityManager->persist($playerToTournament);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            $playerToTournament = $this->getPlayerToTournament($player, $tournament);
        }

        return $playerToTournament;
    }

    /**
     * @param Player $player
     * @param Tournament $tournament
     * @return boolean
     */
    public function checkPlayerInTournament(Player $player, Tournament $tournament)
    {
        $playerToTournament = $this->getPlayerToTournament($player, $tournament);

        return (null === $playerToTournament) ? true : false;
    }

    /**
     * @param Player $player
     * @param Tournament $tournament
     * @return array
     */
    public function getPlayerToTournament(Player $player, Tournament $tournament)
    {
        $playerToTournament = $this->playerToTournamentRepository->findOneBy(array(
            'player' => $player->getId(),
            'tournament' => $tournament->getId()
        ));

        return $playerToTournament;
    }
}