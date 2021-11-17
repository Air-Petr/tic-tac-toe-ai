<?php

namespace AirPetr\TicTacToeAi\MoveMakers;

use AirPetr\TicTacToeAi\Board;

/**
 * Random maker.
 *
 * Place a mark randomly.
 */
class RandomMaker implements MoveMakerInterface
{
    /**
     * @inheritDoc
     */
    public function makeMove(string $mark, Board $board): Board
    {
        $plainArrayState = $board->toPlainArray();
        $keysOfEmptyCells = array_keys($plainArrayState, '_');
        $plainArrayState[$keysOfEmptyCells[array_rand($keysOfEmptyCells)]] = $mark;

        return Board::createByPlainArray($plainArrayState);
    }
}
