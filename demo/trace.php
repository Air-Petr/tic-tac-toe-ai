<?php

use AirPetr\TicTacToeAi\Board;
use AirPetr\TicTacToeAi\Player;

require __DIR__ . '/../vendor/autoload.php';

$player = Player::hard();
$newBoard = $player->placeMark('O', Board::createByString('_X___XOOX'));

echo $newBoard->toString() . "\n"; // _X___XOOXO
