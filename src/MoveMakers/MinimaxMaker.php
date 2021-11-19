<?php

namespace AirPetr\TicTacToeAi\MoveMakers;

use AirPetr\TicTacToeAi\Board;
use AirPetr\TicTacToeAi\Classes\BoardNode;
use AirPetr\TicTacToeAi\Minimax\Minimax;

/**
 * Minimax maker.
 */
class MinimaxMaker implements MoveMakerInterface
{
    /**
     * @inheritDoc
     */
    public function makeMove(string $mark, Board $board): Board
    {
        $boardTable = $board->toArrayTable();
        $bestValue = -1000;
        $bestMove = [-1, -1];

        for($i = 0; $i < 3; $i++) {
            for($j = 0; $j < 3; $j++) {
                if ($boardTable[$i][$j] === '_') {
                    $boardTable[$i][$j] = $mark;

                    $minimaxServer = new Minimax();
                    $minimaxNode = new BoardNode(Board::createByArrayTable($boardTable), $mark);
                    $moveValue = $minimaxServer->minimax($minimaxNode, false);

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
}
