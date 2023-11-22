<?php

abstract class Player
{
    protected $name;
    protected $ratio;

    public function __construct($name, $ratio = 400.0)
    {
        $this->name = $name;
        $this->ratio = $ratio;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRatio()
    {
        return $this->ratio;
    }

    protected final function probabilityAgainst(Player $player)
    {
        return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
    }

    public final function updateRatioAgainst(Player $player, $result): void
    {
        $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
    }
}

final class QueuingPlayer extends Player
{
    private $range;

    public function __construct($name, $ratio = 400.0, $range = 0)
    {
        parent::__construct($name, $ratio);
        $this->range = $range;
    }

    public function getRange(): int
    {
        return $this->range;
    }
}

class Lobby
{
    public $queuingPlayers = [];

    public function findOpponents(QueuingPlayer $player)
    {
        $minLevel = round($player->getRatio() / 100);
        $maxLevel = $minLevel + $player->getRange();

        return array_filter($this->queuingPlayers, function ($potentialOpponent) use ($minLevel, $maxLevel, $player) {
            $playerLevel = round($potentialOpponent->getRatio() / 100);

            return $player !== $potentialOpponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
        });
    }

    public function addPlayer(Player $player)
    {
        $this->queuingPlayers[] = new QueuingPlayer($player->getName(), $player->getRatio());
    }

    public function addPlayers(Player ...$players)
    {
        foreach ($players as $player) {
            $this->addPlayer($player);
        }
    }
}
$greg = new QueuingPlayer('greg', 400);
$jade = new QueuingPlayer('jade', 476);


$lobby = new Lobby();
$lobby->addPlayers($greg, $jade);

var_dump($lobby->findOpponents($lobby->queuingPlayers[0]));

exit(0);
