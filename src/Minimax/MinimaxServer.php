<?php

namespace AirPetr\TicTacToeAi\Minimax;

/**
 * Minimax server interface.
 */
interface MinimaxServer
{
    /**
     * Minimax function.
     *
     * @param MinimaxNode $node
     * @param bool $isMaximizing
     *
     * @return int
     */
    public function minimax(MinimaxNode $node, bool $isMaximizing): int;
}
