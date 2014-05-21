<?php


namespace Galileo\SimpleBet\MigrationOldBundle\Migrate;


use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Score;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateMecze extends Write
{

    private $link;

    /**
     * @var UserMigrate
     */
    private $user;

    /**
     * @var TeamMigrate
     */
    private $teamMigrate;

    function __construct($link, $em, OutputInterface $output, UserMigrate $user, TeamMigrate $teamMigrate)
    {
        $this->link = $link;
        $this->em = $em;
        $this->output = $output;
        $this->user = $user;
        $this->teamMigrate = $teamMigrate;
    }

    public function execute($torunamentStage)
    {
        $this->write('[BEGIN][MECZE]');

        $stmt = mysqli_query($this->link, 'SELECT * FROM typy_mecz');
        $rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

        $bets = new MigrateBets($this->link, $this->em, $this->user);

        foreach ($rows as $row) {
            $homeId = $this->teamMigrate->getNewIdByOldName($row['zespol1']);
            $homeTeam = $this->teamMigrate->getTeamObject($homeId);
            $awayId = $this->teamMigrate->getNewIdByOldName($row['zespol2']);
            $awayTeam = $this->teamMigrate->getTeamObject($awayId);
            $score = new Score();
            $score->setHome($row['gole1']);
            $score->setAway($row['gole2']);
            $score->setScoreType('simple');
            $this->em->persist($score);

            $game = new Game();
            $game->setHomeTeam($homeTeam);
            $game->setAwayTeam($awayTeam);
            $game->setIsActive(false);
            $game->setIsPlayed(true);
            $game->setTournamentStage($torunamentStage);
            $game->setDate($row['data']);
            $game->setScore($score);

            $this->save($game);

            $bets->execute($game, $row['id']);
        }
    }
}