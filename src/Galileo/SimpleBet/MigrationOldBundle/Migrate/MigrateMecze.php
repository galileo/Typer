<?php


namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;


class MigrateMecze extends Write
{

    private $link;

    /**
     * @var UserMigrate
     */
    private $user;

    function __construct($link, $em, \Symfony\Component\Console\Output\OutputInterface $output, UserMigrate $user)
    {
        $this->link = $link;
        $this->em = $em;
        $this->output = $output;
        $this->user = $user;
    }

    public function execute()
    {
        $this->write('[BEGIN][MECZE]');
    }

} 