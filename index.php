<?php

class Player 
{
    private $level;

    public function __construct($level)
    {
        $this->setLevel($level);
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }
}

class Encounter
{
    const RESULT_WINNER = 1;
    const RESULT_LOSER = -1;
    const RESULT_DRAW = 0;
    public static $RESULT_POSSIBILITIES = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];

    public static function probabilityAgainst($levelPlayerOne, $againstLevelPlayerTwo)
    {
        return 1 / (1 + (10 ** (($againstLevelPlayerTwo - $levelPlayerOne) / 400)));
    }

    public static function setNewLevel(Player $playerOne, Player $playerTwo, $playerOneResult)
    {
        if (!in_array($playerOneResult, self::$RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', self::$RESULT_POSSIBILITIES)));
        }

        $levelPlayerOne = $playerOne->getLevel();
        $againstLevelPlayerTwo = $playerTwo->getLevel();

        $newLevelPlayerOne = $levelPlayerOne + (int) (32 * ($playerOneResult - self::probabilityAgainst($levelPlayerOne, $againstLevelPlayerTwo)));

        $playerOne->setLevel($newLevelPlayerOne);
    }
}

$greg = new Player(400);
$jade = new Player(800);

echo sprintf(
    'Greg a %.2f%% chance de gagner face à Jade',
    Encounter::probabilityAgainst($greg->getLevel(), $jade->getLevel()) * 100
) . PHP_EOL;

Encounter::setNewLevel($greg, $jade, Encounter::RESULT_WINNER);
Encounter::setNewLevel($jade, $greg, Encounter::RESULT_LOSER);

echo sprintf(
    'Les niveaux des joueurs ont évolué vers %s pour Greg et %s pour Jade',
    $greg->getLevel(),
    $jade->getLevel()
);

exit(0);
