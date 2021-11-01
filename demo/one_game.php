<?php

require __DIR__ . '/../vendor/autoload.php';

use AirPetr\TicTacToeAi\Classes\Game;

$game = new Game();

while (!$game->isOver()) {
    $game->takeTurn();

    echo "turn {$game->turn()}: \n";

    foreach ($game->getBoard()->toArrayTable() as $row) {
        echo "    ";

        foreach ($row as $cell) {
            echo " " . $cell . " ";
        }

        echo "\n";
    }

    echo "\n";
}
