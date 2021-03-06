<?php
namespace Galileo\SimpleBet\MigrationOldBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Galileo\SimpleBet\MigrationOldBundle\Migrate\MigrateOldDatabase;

class MigrateCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('g:sb:migrate')
            ->setDescription('This is only developer command, for migrating prepared database.');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('No to migrujemy.');

        $entityManager = $this->getContainer()
                              ->get('doctrine.orm.entity_manager');

        $migrate = new MigrateOldDatabase($entityManager, $output);
//        $migrate->execute('galileo2_typer', 'Euro 2008 - Austria i Szwajcaria');
//        $migrate->execute('galileo2_rpa', 'Mistrzostwa Świata 2010 - RPA');
        $migrate->execute('galileo2_euro2012', 'Euro 2012 - Polska i Ukraina');
    }

}
