<?php

require __DIR__ . '/../vendor/autoload.php';

$board = new \AirPetr\TicTacToeAi\Board();
$consoleCleaner = new \AirPetr\ConsoleCleaner();

$userSide = askUserSide();
$aiPlayerSide = ($userSide === 'X') ? 'O' : 'X';

$player1Move = ($userSide === 'X') ? 'askUserMove' : 'makeAIMove';
$player2Move = ($player1Move === 'makeAIMove') ? 'askUserMove' : 'makeAIMove';
$boardIsPrinted = false;

while (!gameIsOver($board)) {
    $board = $player1Move($board);

    if (gameIsOver($board)) {
        if ($userSide  === 'O') {
            $consoleCleaner->clean(4);
            printBoard($board);
        }
        break;
    }

    if ($userSide  === 'X') {
        if ($boardIsPrinted) {
            $consoleCleaner->clean(4);
        }
        $board = $player2Move($board);

        printBoard($board);
    } else {
        if ($boardIsPrinted) {
            $consoleCleaner->clean(4);
        }

        printBoard($board);
        $board = $player2Move($board);
    }

    $boardIsPrinted = true;
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
    global $userSide, $consoleCleaner;

    while (true) {
        $userMove = explode(' ', readline("Your move (row col, zero-based): "));

        if (count($userMove) === 2) {
            $row = $userMove[0];
            $col = $userMove[1];
            $validVariants = ['0', '1', '2'];

            if (
                in_array($row, $validVariants)
                && in_array($col, $validVariants)
                && !in_array($board->toArrayTable()[$row][$col], ['X', 'O'])
            ) {
                $board->put($userSide, (int) $userMove[0], (int) $userMove[1]);
                return $board;
            }
        }

        $consoleCleaner->clean(1);
        echo "Wrong position! ";
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
