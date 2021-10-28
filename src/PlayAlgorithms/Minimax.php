<?php

namespace AirPetr\TicTacToeAi\PlayAlgorithms;

use AirPetr\TicTacToeAi\Board;

/**
 * Minimax play algorithm.
 */
class Minimax implements PlayAlgorithmInterface
{
    /**
     * Player's side.
     *
     * @var string
     */
    protected $player;

    /**
     * Opponent's side.
     *
     * @var string
     */
    protected $opponent;

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
        $this->player = $mark;
        $this->opponent = ($mark === 'X') ? 'O' : 'X';

        $boardTable = $board->toArrayTable();
        $bestValue = -1000;
        $bestMove = [-1, -1];

        for($i = 0; $i < 3; $i++) {
            for($j = 0; $j < 3; $j++) {
                if ($boardTable[$i][$j] === '_') {
                    $boardTable[$i][$j] = $this->player;

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

    /**
     * Minimax function.
     *
     * @param Board $board
     * @param int $depth
     * @param bool $isMax
     *
     * @return int
     */
    protected function minimax(Board $board, int $depth, bool $isMax): int
    {
        $score = $this->evaluateBoard($board);
        $boardTable = $board->toArrayTable();

        if ($score === 10) {
            return $score - $depth;
        } elseif ($score === -10) {
            return $score + $depth;
        } elseif (!$board->hasEmptyCells()) {
            return 0;
        } elseif ($isMax) {
            $best = -1000;

            for($i = 0; $i < 3; $i++) {
                for($j = 0; $j < 3; $j++) {
                    if ($boardTable[$i][$j] === '_') {
                        $boardTable[$i][$j] = $this->player;
                        $best = max($best, $this->minimax(Board::createByArrayTable($boardTable), $depth + 1, !$isMax));
                        $boardTable[$i][$j] = '_';
                    }
                }
            }

            return $best;
        } else {
            $best = 1000;

            for($i = 0; $i < 3; $i++) {
                for($j = 0; $j < 3; $j++) {
                    if ($boardTable[$i][$j] === '_') {
                        $boardTable[$i][$j] = $this->opponent;
                        $best = min($best, $this->minimax(Board::createByArrayTable($boardTable), $depth + 1, !$isMax));
                        $boardTable[$i][$j] = '_';
                    }
                }
            }

            return $best;
        }
    }

    /**
     * Board evaluation.
     *
     * @param Board $b
     *
     * @return int
     */
    protected function evaluateBoard(Board $b): int
    {
        switch ($b->evaluate()) {
            case $this->player:
                return 10;
            case $this->opponent:
                return -10;
            default:
                return 0;
        }
    }
}
