<?php

namespace AirPetr\TicTacToeAi\PlayAlgorithms;

use AirPetr\TicTacToeAi\Board;

/**
 * Human algorithm.
 *
 * Acts randomly but uses minimax before win or lose.
 */
class Human implements PlayAlgorithmInterface
{
    /**
     * @var Board
     */
    protected $board;

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
        $this->board = $board;

        $algorithm = $this->nextTurnCanBeLast()
            ? new Minimax()
            : new Random();

        return $algorithm->getBoardWithNewMark($mark, $board);
    }

    /**
     * Check whether next turn can be last.
     *
     * @return bool
     */
    protected function nextTurnCanBeLast(): bool
    {
        $numericBoard = $this->getNumericBoard();

        foreach ($this->getLineIndexes() as $lineIndexes) {
            $result = 0;

            foreach ($lineIndexes as $i) {
                $result += $numericBoard[$i];
            }

            if (abs($result) === 2) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return numeric board.
     *
     * Transform marks to numbers.
     *
     * @return array
     */
    protected function getNumericBoard(): array
    {
        $board = $this->board->toPlainArray();

        foreach ($board as $key => $cell) {
            switch ($cell) {
                case 'X':
                    $board[$key] = 1;
                    break;
                case 'O':
                    $board[$key] = -1;
                    break;
                default:
                    $board[$key] = 0;
                    break;
            }
        }

        return $board;
    }

    /**
     * Return indexes of lines on a bord.
     *
     * @return \int[][]
     */
    protected function getLineIndexes(): array
    {
        return [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            [0, 4, 8],
            [2, 4, 6],
        ];
    }
}
