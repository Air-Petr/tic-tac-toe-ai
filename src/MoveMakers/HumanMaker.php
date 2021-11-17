<?php

namespace AirPetr\TicTacToeAi\MoveMakers;

use AirPetr\TicTacToeAi\Board;

/**
 * Human move maker.
 *
 * Acts randomly but uses minimax in critical situations.
 */
class HumanMaker implements MoveMakerInterface
{
    /**
     * @var Board
     */
    protected $board;

    /**
     * @inheritDoc
     */
    public function makeMove(string $mark, Board $board): Board
    {
        $this->board = $board;

        $maker = $this->nextTurnCanBeLast()
            ? new MinimaxMaker()
            : new RandomMaker();

        return $maker->makeMove($mark, $board);
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
