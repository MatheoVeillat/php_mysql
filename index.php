<?php

/*
 * This file is part of the OpenClassRoom PHP Object Course.
 *
 * (c) Grégoire Hébert <contact@gheb.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class QueuingPlayer extends Player 
{
    private $range;

    public function __construct($name, $ratio = 400.0, $range = 0)
    {
        parent::__construct($name, $ratio);
        $this->range = $range;
    }

    public function getRange()
    {
        return $this->range;
    }
}


class Lobby
{
    public $queuingPlayers = [];

    public function findOponents(QueuingPlayer $player) {
        $minLevel = round($player->getRatio() / 100);
        $maxLevel = $minLevel + $player->getRange();

        return array_filter($this->queuingPlayers, function ($potentialOponent) use ($minLevel, $maxLevel, $player) {
            $playerLevel = round($potentialOponent->getRatio() / 100);

            return $player !== $potentialOponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
        });
    }

    public function addPlayer(Player $player) {
        $this->queuingPlayers[] = new QueuingPlayer($player);
    }

    public function addPlayers(Player ...$players) {
        foreach ($players as $player) {
            $this->addPlayer($player);
        }
    }
}

class Player
{
    public function __construct($name, $ratio = 400.0) {
        $this->name = $name;
        $this->ratio = $ratio;
    }

    public function getName() {
        return $this->name;
    }

    private function probabilityAgainst($player) {
        return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
    }

    public function updateRatioAgainst($player, $result) {
        $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
    }

    public function getRatio() {
        return $this->ratio;
    }
}

$greg = new Player('greg', 400);
$jade = new Player('jade', 476);

$lobby = new Lobby();
$lobby->addPlayers($greg, $jade);

var_dump($lobby->findOponents($lobby->queuingPlayers[0]));

exit(0);
