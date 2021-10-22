<?php

namespace AirPetr\TicTacToeAi\Classes;

use Exception;

class ConfigValidator
{
    protected const WRONG_BOARD_SIZE_MESSAGE = 'Wrong board size';
    protected const WRONG_BOARD_SYMBOL_MESSAGE = 'Wrong board symbol';

    /**
     * Validate array table config.
     *
     * @param array $config
     *
     * @throws Exception
     */
    public static function validateArrayTable(array $config): void
    {
        if (count(array_merge(...$config)) !== 9) {
            throw new Exception(self::WRONG_BOARD_SIZE_MESSAGE);
        }

        foreach ($config as $row) {
            foreach ($row as $symbol) {
                if (!in_array($symbol, ['_', 'X', 'O'])) {
                    throw new Exception(self::WRONG_BOARD_SYMBOL_MESSAGE);
                }
            }
        }
    }

    /**
     * Validate plain array config.
     *
     * @param array $config
     *
     * @throws Exception
     */
    public static function validatePlainArray(array $config): void
    {
        if (count($config) !== 9) {
            throw new Exception(self::WRONG_BOARD_SIZE_MESSAGE);
        }

        foreach ($config as $symbol) {
            if (!in_array($symbol, ['_', 'X', 'O'])) {
                throw new Exception(self::WRONG_BOARD_SYMBOL_MESSAGE);
            }
        }
    }
}
