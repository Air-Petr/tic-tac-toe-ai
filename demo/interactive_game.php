<?php

require __DIR__ . '/../vendor/autoload.php';

$board = new \AirPetr\TicTacToeAi\Board();

$userSide = askUserSide();
$aiPlayerSide = ($userSide === 'X') ? 'O' : 'X';

$player1Move = ($userSide === 'X') ? 'askUserMove' : 'makeAIMove';
$player2Move = ($player1Move === 'makeAIMove') ? 'askUserMove' : 'makeAIMove';

while (!gameIsOver($board)) {
    $board = $player1Move($board);

    if (gameIsOver($board)) {
        break;
    }

    if ($userSide  === 'X') {
        $board = $player2Move($board);
        printBoard($board);
    } else {
        printBoard($board);
        $board = $player2Move($board);
    }
}

printGameResult($board);
die();

// End of the script.

function askUserSide() {
    while (true) {
        $userSide = readline("Choose your side (X/O): ");

        if (in_array($userSide, ['X', 'O'])) {
            return $userSide;
        }

        echo "Wrong symbol, should be X or O\n";
    }
}

function gameIsOver($board) {
    return in_array($board->evaluate(), ['X', 'O']) || !$board->hasEmptyCells();
}

function askUserMove($board) {
    global $userSide;

    while (true) {
        $userMove = explode(' ', readline("Your move: "));

        if (in_array($userSide, ['X', 'O'])) {
            $board->put($userSide, $userMove[0], $userMove[1]);
            return $board;
        }

        echo "Wrong position\n";
    }
}

function makeAIMove($board) {
    global $aiPlayerSide;

    $aiPlayer = \AirPetr\TicTacToeAi\Player::normal();
    return $aiPlayer->placeMark($aiPlayerSide, $board);
}

function printBoard($board) {
    foreach ($board->toArrayTable() as $row) {
        echo "    ";

        foreach ($row as $cell) {
            echo " " . $cell . " ";
        }

        echo "\n";
    }
}

function printGameResult($board) {
    echo "Game is over\n";

    if ($board->evaluate() === '_') {
        echo "It's draw!";
    } else {
        echo $board->evaluate() . " is winner!";
    }

    echo "\n";
}
