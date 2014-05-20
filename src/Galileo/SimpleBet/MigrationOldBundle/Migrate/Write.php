<?php


namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;


class Write
{

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output = null;


    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;


    public function write($message)
    {
        if (null !== $this->output) {
            $this->output->writeln($message);
        }
    }

    public function save($object)
    {
        if (null !== $this->em) {
            $this->em->persist($object);
            $this->em->flush();
        } else {
            $this->write('Hej nie da się zapisać tego!');
        }

    }

} 