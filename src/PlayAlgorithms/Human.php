<?php

namespace AirPetr\TicTacToeAi\PlayAlgorithms;

use AirPetr\TicTacToeAi\Board;

/**
 * Human play algorithm.
 */
class Human extends Minimax
{
    /**
     * Human minimax function.
     *
     * @param Board $board
     * @param int $depth
     * @param bool $isMax
     *
     * @return int
     */
    protected function minimax(Board $board, int $depth, bool $isMax): int
    {
        if ($depth > 2 && (rand(0, 99) < 75)) {
            if ($isMax) {
                return parent::minimax($board, $depth, $isMax) + 10;
            } else {
                return parent::minimax($board, $depth, $isMax) - 10;
            }
        }

        return parent::minimax($board, $depth, $isMax);
    }
}
