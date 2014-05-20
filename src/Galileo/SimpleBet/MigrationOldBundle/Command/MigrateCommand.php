<?php
namespace Galileo\SimpleBet\MigrationOldBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('g:sb:migrate')
            ->setDescription('This is only developer command, for migrating prepared database.')
            ->addOption('host', null, InputOption::VALUE_REQUIRED, 'Host to database from old system')
            ->addOption('database_name', 'd', InputOption::VALUE_REQUIRED)
            ->addOption('user', 'd', InputOption::VALUE_REQUIRED)
            ->addOption('password', 'd', InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('No to migrujemy.');
    }
}