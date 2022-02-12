<?php

require __DIR__ . '/../vendor/autoload.php';

$game = new \AirPetr\TicTacToeAi\Classes\Game();
$consoleCleaner = new \AirPetr\ConsoleCleaner();

while (true) {
    $game->takeTurn();

    echo "turn {$game->turn()}: \n";

    foreach ($game->getBoard()->toArrayTable() as $row) {
        echo "    ";

        foreach ($row as $cell) {
            echo " " . $cell . " ";
        }

        echo "\n";
    }

    if (!$game->isOver()) {
        sleep(1);
        $consoleCleaner->clean(4);
    } else {
        break;
    }
}

function printGameResult ($board) {
    if ($board->evaluate() === '_') {
        echo "It's draw!";
    } else {
        echo $board->evaluate() . " is winner!";
    }

    echo "\n";
};

printGameResult($game->getBoard());

