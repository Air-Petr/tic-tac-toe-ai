<?php

namespace AirPetr\TicTacToeAi\Minimax;

class Minimax implements MinimaxServer
{
    /**
     * Minimax function.
     *
     * @param MinimaxNode $node
     * @param bool $isMaximizing
     *
     * @return mixed
     */
    public function minimax(MinimaxNode $node, bool $isMaximizing)
    {
        if ($node->isWin() === 10) {
            return $node->score() - $node->depth();
        } elseif ($node->isLoose() === -10) {
            return $node->score()+ $node->depth();
        } elseif ($node->isDraw()) {
            return 0;
        } elseif ($isMaximizing) {
            $best = -1000;

            foreach ($node->playerChildNodes() as $childNode) {
                $best = max($best, $this->minimax($childNode, !$isMaximizing));
            }
        } else {
            $best = 1000;

            foreach ($node->opponentChildNodes() as $childNode) {
                $best = min($best, $this->minimax($childNode, !$isMaximizing));
            }
        }
    }
}
