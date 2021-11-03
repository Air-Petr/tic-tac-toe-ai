<?php

require __DIR__ . '/../vendor/autoload.php';

use AirPetr\TicTacToeAi\Classes\Game;

$games = 100;
$player1Wins = 0;
$player2Wins = 0;
$draws = 0;

for ($i = 0; $i < $games; $i++) {
    $game = new Game();
    $result = $game->play();

    switch ($result) {
        case 'X':
            $player1Wins++;
            break;
        case 'O':
            $player2Wins++;
            break;
        case '_':
            $draws++;
            break;
    }
}

printf("Player 1 wins: $player1Wins\n");
printf("Player 2 wins: $player2Wins\n");
printf("Draws: $draws\n");
