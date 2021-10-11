<?php

namespace AirPetr\TicTacToeAi;

use AirPetr\TicTacToeAi\Enum\PlayerDifficulty;

/**
 * AI Tic-tac-toe player.
 */
class Player
{
    /**
     * Difficulty of a player.
     *
     * @var int
     */
    private $difficulty;

    /**
     * @param int $difficulty
     */
    public function __construct(int $difficulty = PlayerDifficulty::NORMAL)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * Return easy player.
     *
     * @return Player
     */
    public static function easy(): Player
    {
        return new self(PlayerDifficulty::EASY);
    }

    /**
     * Return normal player.
     *
     * @return Player
     */
    public static function normal(): Player
    {
        return new self(PlayerDifficulty::NORMAL);
    }

    /**
     * Return hard player.
     *
     * @return Player
     */
    public static function hard(): Player
    {
        return new self(PlayerDifficulty::HARD);
    }

    /**
     * Place mark on a board.
     *
     * @param string $mark
     * @param Board $board
     *
     * @return Board
     */
    public function placeMark(string $mark, Board $board): Board
    {
        return new Board;
    }
}
