<?php

namespace AirPetr\TicTacToeAi\Minimax;

interface MinimaxNode
{
    /**
     * Does player win.
     *
     * @return bool
     */
    public function isWin(): bool;

    /**
     * Does player lose.
     *
     * @return bool
     */
    public function isLoose(): bool;

    /**
     * Is it draw.
     *
     * @return bool
     */
    public function isDraw(): bool;

    /**
     * Player score.
     *
     * @return int
     */
    public function score(): int;

    /**
     * Node depth.
     *
     * @return int
     */
    public function depth(): int;

    /**
     * Return player child nodes generator.
     *
     * @return mixed
     */
    public function playerChildNodes(): callable;

    /**
     * Return opponent child nodes generator.
     *
     * @return mixed
     */
    public function opponentChildNodes(): callable;
}
