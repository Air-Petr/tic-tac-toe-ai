<?php

namespace AirPetr\TicTacToeAi\MoveMakers;

use AirPetr\TicTacToeAi\Enum\PlayerDifficulty;

/**
 * Move maker factory.
 *
 * Create move makers by player difficulty.
 */
class MoveMakerFactory
{
    /**
     * Return move maker.
     *
     * @param string $playerDifficulty
     *
     * @return MoveMakerInterface
     */
    public static function create(string $playerDifficulty): MoveMakerInterface
    {
        switch ($playerDifficulty) {
            case PlayerDifficulty::HARD:
                return new MinimaxMaker();
            case PlayerDifficulty::NORMAL:
                return new HumanMaker();
            case PlayerDifficulty::EASY:
                return new RandomMaker();
        }
    }
}
