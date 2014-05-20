<?php


namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;


use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;

class UserMigrate
{

    private $mysqlLink;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    private $user = array();
    /**
     * @var null
     */
    private $output;

    protected function write($message)
    {
        if (null !== $this->output) {
            $this->output->writeln($message);
        }
    }

    function __construct($mysqlLink, $em, \Symfony\Component\Console\Output\OutputInterface $output = null)
    {
        $this->mysqlLink = $mysqlLink;
        $this->em = $em;
        $this->output = $output;
    }

    protected function findByEmail($email)
    {
        return $this->em->getRepository('GalileoSimpleBetModelBundle:Player')->findOneByEmail($email);
    }

    protected function save($player)
    {
        $this->em->persist($player);
        $this->em->flush();
    }

    public function execute()
    {
        $stmt = mysqli_query(
            $this->mysqlLink, 'SELECT * FROM sf_guard_user u
        JOIN sf_guard_user_profile p ON u.id = p.user_id

        '
        );

        $rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        foreach ($rows as $row) {

            $player = $this->findByEmail($row['email']);

            if (!$player) {
                $this->write("Użytkownik {$row['email']} jeszcze nie istniteje zostanie stworzony.");

                $player = new Player();
                $lowerEmail = strtolower($row['email']);
                $player->setEmail($lowerEmail);
                $player->setUsername($lowerEmail);
                $player->setPassword(md5(rand(0, 1239124), microtime()));
                $player->setFirstName($row['first_name']);
                $player->setLastName($row['last_name']);

                $this->save($player);
            } else {
                $this->write("Znaleziono użytkownika {$player->getEmail()}");
            }

            $this->addUser($row['id'], $player->getId());
        }
    }

    protected function addUser($oldId, $newId)
    {
        $this->write("Dodany użytkowink $oldId => $newId");
        $this->user[$oldId] = $newId;
    }

    public function getNewForOld($oldId)
    {
        return $this->user[$oldId];
    }

    public function getOldForNew($newId)
    {
        return array_search($newId, $this->user);
    }
}