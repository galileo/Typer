<?php


namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;


use Doctrine\ORM\EntityManager;
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

    public function execute($databaseName)
    {
        $this->write("[MIGRACJA]Rozpoczynam migracje dla $databaseName");

        $link = mysqli_connect('gallio.pl', 'galileo2', 'kamil1986', $databaseName);

        $userMigrate = new UserMigrate($link, $this->em, $this->output);
        $userMigrate->execute();

        $teamMigrate = new TeamMigrate($link, $this->em, $this->output);
        $teamMigrate->execute();

        $mecze = new MigrateMecze($link, $this->em, $this->output, $userMigrate, $teamMigrate);
        $mecze->execute();

    }
} 