<?php

namespace AirPetr\TicTacToeAi;

use AirPetr\TicTacToeAi\Enum\PlayerDifficulty;
use AirPetr\TicTacToeAi\PlayAlgorithms\Minimax;
use AirPetr\TicTacToeAi\PlayAlgorithms\PlayAlgorithmInterface;
use AirPetr\TicTacToeAi\PlayAlgorithms\Random;

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
    protected $difficulty;

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
        return $this->getAlgorithm()->getBoardWithNewMark($mark, $board);
    }

    /**
     * Return play algorithm.
     *
     * @return PlayAlgorithmInterface
     */
    protected function getAlgorithm(): PlayAlgorithmInterface
    {
        if ($this->difficulty === PlayerDifficulty::HARD) {
            return new Minimax();
        }

        return new Random();
    }
}
