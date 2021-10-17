<?php

namespace AirPetr\TicTacToeAi\PlayAlgorithms;

use AirPetr\TicTacToeAi\Board;

/**
 * Minimax play algorithm.
 */
class Minimax implements PlayAlgorithmInterface
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
        $boardTable = $board->toArrayTable();
        $bestValue = -1000;
        $bestMove = [-1, -1];

        for($i = 0; $i < 3; $i++) {
            for($j = 0; $j < 3; $j++) {
                if ($boardTable[$i][$j] == '_') {
                    $boardTable[$i][$j] = $mark;

                    $moveValue = $this->minimax(Board::createByArrayTable($boardTable), 0, false);

                    $boardTable[$i][$j] = '_';

                    if ($moveValue > $bestValue) {
                        $bestMove[0] = $i;
                        $bestMove[1] = $j;
                        $bestValue = $moveValue;
                    }
                }
            }
        }

        $newBoard = $board->copy();
        $newBoard->put($mark, $bestMove[0], $bestMove[1]);
        return $newBoard;
    }

    protected function minimax(Board $board, int $depth, bool $isMax): int
    {
        return 10;
    }

}
