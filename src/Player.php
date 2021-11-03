<?php

namespace AirPetr\TicTacToeAi;

use AirPetr\TicTacToeAi\PlayAlgorithms\Random;
use Exception;
use AirPetr\TicTacToeAi\Enum\PlayerDifficulty;
use AirPetr\TicTacToeAi\PlayAlgorithms\Minimax;
use AirPetr\TicTacToeAi\PlayAlgorithms\Human;
use AirPetr\TicTacToeAi\PlayAlgorithms\PlayAlgorithmInterface;

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
     * @throws Exception
     */
    public function placeMark(string $mark, Board $board): Board
    {
        if (!$board->hasEmptyCells()) {
            throw new Exception("Board have no empty cells");
        }

        if (!$board->validateMove($mark)) {
            throw new Exception("Player can't put '$mark' now");
        }

        return $this->getAlgorithm()->getBoardWithNewMark($mark, $board);
    }

    /**
     * Return play algorithm.
     *
     * @return PlayAlgorithmInterface
     */
    protected function getAlgorithm(): PlayAlgorithmInterface
    {
        switch ($this->difficulty) {
            case PlayerDifficulty::HARD:
                return new Minimax();
            case PlayerDifficulty::NORMAL:
                return new Human();
            default:
                return new Random();
        }
    }
}
