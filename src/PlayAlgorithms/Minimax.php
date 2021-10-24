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
        $score = $this->evaluateBoard($board->toArrayTable());
        $boardTable = $board->toArrayTable();

        if ($score === 10) {
            return $score - $depth;
        } elseif ($score === -10) {
            return $score + $depth;
        } elseif (!$this->isMovesLeft($board)) {
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
     * @param array $b
     *
     * @return int
     */
    protected function evaluateBoard(array $b): int
    {
        for ($row = 0; $row < 3; $row++) {
            if ($b[$row][0] === $b[$row][1] && $b[$row][1] === $b[$row][2]) {
                if ($b[$row][0] === $this->player) {
                    return 10;
                } elseif ($b[$row][0] === $this->opponent) {
                    return -10;
                }
            }
        }

        for ($col = 0; $col < 3; $col++) {
            if ($b[0][$col] === $b[1][$col] && $b[1][$col] === $b[2][$col]) {
                if ($b[0][$col] === $this->player) {
                    return 10;
                } elseif ($b[0][$col] === $this->opponent) {
                    return -10;
                }
            }
        }

        if ($b[0][0] === $b[1][1] && $b[1][1] === $b[2][2]) {
            if ($b[0][0] === $this->player) {
                return 10;
            } elseif ($b[0][0] === $this->opponent) {
                return -10;
            }
        }

        if ($b[0][2] === $b[1][1] && $b[1][1] === $b[2][0]) {
            if ($b[0][2] === $this->player) {
                return 10;
            } elseif ($b[0][2] === $this->opponent) {
                return -10;
            }
        }

        return 0;
    }

    /**
     * Check if moves can be made on a board.
     *
     * @param Board $board
     *
     * @return bool
     */
    protected function isMovesLeft(Board $board): bool
    {
        return (array_search('_', $board->toPlainArray()) !== false);
    }

}
