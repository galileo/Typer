<?php


namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;


use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\ModelBundle\Entity\Tournament;
use Galileo\SimpleBet\ModelBundle\Entity\TournamentStage;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateOldDatabase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    private $output;

    public function __construct($em, OutputInterface $output = null)
    {
        $this->em = $em;
        $this->output = $output;
    }

    protected function write($message)
    {
        if (null !== $this->output) {
            $this->output->writeln($message);
        }
    }

    public function execute($databaseName, $tournamentName)
    {
        $this->em->beginTransaction();
        $this->write("[MIGRACJA]Rozpoczynam migracje dla $databaseName");

        $tournament = new Tournament();
        $tournament->setName($tournamentName);

        $tournamentStage = new TournamentStage();
        $tournamentStage->setName('Wszystkie mecze');
        $tournamentStage->setTournament($tournament);

        $this->em->persist($tournament);
        $this->em->persist($tournamentStage);
        $this->em->flush();

        $link = mysqli_connect('gallio.pl', 'galileo2', 'kamil1986', $databaseName);

        $userMigrate = new UserMigrate($link, $this->em, $this->output);
        $userMigrate->execute($tournament);

        $teamMigrate = new TeamMigrate($link, $this->em, $this->output);
        $teamMigrate->execute();

        $mecze = new MigrateMecze($link, $this->em, $this->output, $userMigrate, $teamMigrate);
        $mecze->execute($tournamentStage);

        $this->em->commit();

    }
} 