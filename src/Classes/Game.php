<?php

namespace AirPetr\TicTacToeAi\Classes;

use AirPetr\TicTacToeAi\Board;
use AirPetr\TicTacToeAi\Player;
use PhpParser\Node\Expr\Yield_;

/**
 * Game emulation.
 */
class Game
{
    /**
     * Round number.
     *
     * @var int
     */
    protected $turn;

    /**
     * Game board.
     *
     * @var Board
     */
    protected $board;

    /**
     * Player 1.
     *
     * @var array
     */
    protected $player1;

    /**
     * Player 2.
     *
     * @var array
     */
    protected $player2;

    /**
     * Turn side.
     * @var array
     */
    protected $whoIsNext;

    public function __construct()
    {
        $this->board = new Board();

        $this->player1 = [
            'player' => Player::hard(),
            'mark' => 'X'
        ];

        $this->player2 = [
            'player' => Player::normal(),
            'mark' => 'O'
        ];

        $this->turn = 0;
        $this->whoIsNext = $this->player1;
    }

    /**
     * Return number of a turn.
     *
     * @return int
     */
    public function turn(): int
    {
        return $this->turn;
    }

    /**
     * Show whether game is over.
     *
     * @return bool
     */
    public function isOver(): bool
    {
        return in_array($this->board->evaluate(), ['X', 'O']) || !$this->board->hasEmptyCells();
    }

    /**
     * Make a turn.
     */
    public function takeTurn(): void
    {
        $this->board = $this->whoIsNext['player']->placeMark($this->whoIsNext['mark'], $this->board);
        $this->changeSide();
        $this->turn++;
    }

    /**
     * Return game board.
     *
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * Set player 1.
     *
     * @param Player $player1
     */
    public function setPlayer1(Player $player1): void
    {
        $this->player1['player'] = $player1;
    }

    /**
     * Set player 2.
     *
     * @param Player $player2
     */
    public function setPlayer2(Player $player2): void
    {
        $this->player2['player'] = $player2;
    }

    /**
     * Change next turn's side.
     */
    protected function changeSide(): void
    {
        $this->whoIsNext = ($this->whoIsNext === $this->player2)
            ? $this->player1
            : $this->player2;
    }
}
