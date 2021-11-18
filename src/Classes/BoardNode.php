<?php

namespace AirPetr\TicTacToeAi\Classes;

use AirPetr\TicTacToeAi\Board;
use AirPetr\TicTacToeAi\Minimax\MinimaxNode;

class BoardNode implements MinimaxNode
{
    /**
     * Board array table representation.
     *
     * @var array|array[]|\string[][]
     */
    protected array $boardTable;

    /**
     * Node depth.
     *
     * @var int
     */
    protected int $depth;

    /**
     * Mark of a player.
     *
     * @var string
     */
    protected string $player;

    /**
     * Mark of a opponent.
     *
     * @var string
     */
    protected string $opponent;

    /**
     * Board.
     *
     * @var Board
     */
    protected Board $board;

    /**
     * Node score.
     *
     * @var int
     */
    protected int $score;

    public function __construct(Board $board, string $player, int $depth = 0)
    {
        $this->board = $board;
        $this->depth = $depth;

        $this->player = $player;
        $this->opponent = ($player === 'X') ? 'O' : 'X';

        $this->score = $this->evaluateBoard();
    }

    /**
     * @inheritDoc
     */
    public function isWin(): bool
    {
        return $this->score === 10;
    }

    /**
     * @inheritDoc
     */
    public function isLoose(): bool
    {
        return $this->score === -10;
    }

    /**
     * @inheritDoc
     */
    public function isDraw(): bool
    {
        return !$this->board->hasEmptyCells();
    }

    /**
     * @inheritDoc
     */
    public function score(): int
    {
        return $this->score;
    }

    /**
     * @inheritDoc
     */
    public function depth(): int
    {
        return $this->depth;
    }

    /**
     * @inheritDoc
     */
    public function playerChildNodes(): callable
    {
        return $this->getNodeGenerator($this->player);
    }

    /**
     * @inheritDoc
     */
    public function opponentChildNodes(): callable
    {
        return $this->getNodeGenerator($this->opponent);
    }

    /**
     * Return node generator.
     *
     * @param string $mark
     *
     * @return callable
     */
    protected function getNodeGenerator(string $mark): callable
    {
        $boardTable = $this->board->toArrayTable();
        $depth = $this->depth + 1;

        return function () use ($mark, $boardTable, $depth) {
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    if ($boardTable[$i][$j] === '_') {
                        $boardTable[$i][$j] = $mark;
                        $node = new self(Board::createByArrayTable($boardTable), $mark, $depth);
                        $boardTable[$i][$j] = '_';
                        yield $node;
                    }
                }
            }
        };
    }

    /**
     * Board evaluation.
     *
     * @return int
     */
    protected function evaluateBoard(): int
    {
        switch ($this->board->evaluate()) {
            case $this->player:
                return 10;
            case $this->opponent:
                return -10;
            default:
                return 0;
        }
    }
}
