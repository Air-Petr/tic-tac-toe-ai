<?php

require __DIR__ . '/../vendor/autoload.php';

use AirPetr\TicTacToeAi\Board;
use AirPetr\ConsoleCleaner;

$board = new Board();
$consoleCleaner = new ConsoleCleaner();

$userSide = askUserSide();
$aiPlayerSide = ($userSide === 'X') ? 'O' : 'X';

$player1Move = ($userSide === 'X') ? 'askUserMove' : 'makeAIMove';
$player2Move = ($player1Move === 'makeAIMove') ? 'askUserMove' : 'makeAIMove';
$boardIsPrinted = false;

while (!gameIsOver($board)) {
    $board = $player1Move($board);

    if (gameIsOver($board)) {
        if ($userSide  === 'O') {
            cleanConsoleBoard();
            printBoard($board);
        }
        break;
    }

    if ($boardIsPrinted) {
        cleanConsoleBoard();
    }

    if ($userSide  === 'X') {
        $board = $player2Move($board);
        printBoard($board);
    } else {
        printBoard($board);
        $board = $player2Move($board);
    }

    $boardIsPrinted = true;
}

printGameResult($board);

// End of the script.

/**
 * @return void
 */
function askUserSide(): string {
    while (true) {
        $userSide = readline("Choose your side (X/O): ");

        if (in_array($userSide, ['X', 'O'])) {
            return $userSide;
        }

        echo "Wrong symbol, should be X or O\n";
    }
}

/**
 * @param Board $board
 * @return bool
 */
function gameIsOver(Board $board): bool {
    return in_array($board->evaluate(), ['X', 'O']) || !$board->hasEmptyCells();
}

/**
 * @param Board $board
 * @return Board
 */
function askUserMove(Board $board): Board {
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

/**
 * @param Board $board
 * @return void
 */
function printBoard(Board $board): void {
    foreach ($board->toArrayTable() as $row) {
        echo "    ";

        foreach ($row as $cell) {
            echo " " . $cell . " ";
        }

        echo "\n";
    }
}

/**
 * @param Board $board
 * @return Board
 * @throws Exception
 */
function makeAIMove(Board $board): Board {
    global $aiPlayerSide;

    $aiPlayer = \AirPetr\TicTacToeAi\Player::normal();
    return $aiPlayer->placeMark($aiPlayerSide, $board);
}

/**
 * @param Board $board
 * @return void
 */
function printGameResult(Board $board): void {
    echo "Game is over\n";

    if ($board->evaluate() === '_') {
        echo "It's draw!";
    } else {
        echo $board->evaluate() . " is winner!";
    }

    echo "\n";
}

/**
 * @return void
 */
function cleanConsoleBoard(): void {
    global $consoleCleaner;
    $consoleCleaner->clean(4);
}