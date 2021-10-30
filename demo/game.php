<?php

require __DIR__ . '/../vendor/autoload.php';

use AirPetr\TicTacToeAi\Player;
use AirPetr\TicTacToeAi\Board;

$board = new Board();

$side1 = [
    'player' => Player::hard(),
    'mark' => 'X'
];

$side2 = [
    'player' => Player::normal(),
    'mark' => 'O'
];

$turnSide = $side1;
$i = 0;

while (!in_array($board->evaluate(), ['X', 'O']) && $board->hasEmptyCells()) {
    $board = $turnSide['player']->placeMark($turnSide['mark'], $board);
    $turnSide = ($turnSide ===  $side1) ? $side2 : $side1;
    $i++;

    echo "turn $i: \n";

    foreach ($board->toArrayTable() as $row) {
        echo "    ";

        foreach ($row as $cell) {
            echo " " . $cell . " ";
        }

        echo "\n";
    }

    echo "\n";
}

die();
