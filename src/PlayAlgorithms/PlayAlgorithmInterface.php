<?php

namespace AirPetr\TicTacToeAi\PlayAlgorithms;

use AirPetr\TicTacToeAi\Board;

interface PlayAlgorithmInterface
{
    /**
     * Return a board with a new mark (make a move).
     *
     * @param string $mark
     * @param Board $board
     *
     * @return Board
     */
    public function getBoardWithNewMark(string $mark, Board $board): Board;
}
