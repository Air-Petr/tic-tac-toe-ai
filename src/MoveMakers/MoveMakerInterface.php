<?php

namespace AirPetr\TicTacToeAi\MoveMakers;

use AirPetr\TicTacToeAi\Board;

/**
 * Move maker interface.
 */
interface MoveMakerInterface
{
    /**
     * Make a move.
     *
     * @param string $mark
     * @param Board $board
     *
     * @return Board
     */
    public function makeMove(string $mark, Board $board): Board;
}
