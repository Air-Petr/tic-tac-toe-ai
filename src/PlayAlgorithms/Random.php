<?php

namespace AirPetr\TicTacToeAi\PlayAlgorithms;

use AirPetr\TicTacToeAi\Board;

/**
 * Random algorithms.
 *
 * Place a mark randomly.
 */
class Random implements PlayAlgorithmInterface
{
    /**
     * Return a board with a new mark (make a move).
     *
     * @param string $mark
     * @param Board $board
     *
     * @return Board
     */
    public function getBoardWithNewMark(string $mark, Board $board): Board
    {
        $plainArrayState = $board->toPlainArray();
        $keysOfEmptyCells = array_keys($plainArrayState, '_');
        $plainArrayState[$keysOfEmptyCells[array_rand($keysOfEmptyCells)]] = $mark;

        return Board::createByPlainArray($plainArrayState);
    }
}
