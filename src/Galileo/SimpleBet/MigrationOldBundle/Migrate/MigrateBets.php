<?php


namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;


use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Score;

class MigrateBets extends Write
{

    /**
     * @var
     */
    private $link;

    /**
     * @var UserMigrate
     */
    private $user;

    function __construct($link, $em, $user)
    {
        $this->link = $link;
        $this->em = $em;
        $this->user = $user;
    }

    public function execute(Game $game, $oldGameId)
    {
        $sql = 'SELECT t.*, u.email
        FROM typy_typ t
        JOIN sf_guard_user_profile u ON t.user_id = u.id
        WHERE t.mecz_id = ' . $oldGameId;

        $stmt = mysqli_query($this->link, $sql);
        $bets = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

        foreach ($bets as $row)
        {
            $score = new Score();
            $score->setScoreType('simple');
            $score->setHome('gole1');
            $score->setAway('gole2');

            $this->em->persist($score);

            $player = $this->user->findByEmail($row['email']);

            $bet = new Bet();
            $bet->setPlayer($player);
            $bet->setGame($game);
            $bet->setScore($score);
            $bet->setIsActive(false);
            $bet->setPointsEarned($row['punkty']);

            $this->save($bet);
        }
    }

}