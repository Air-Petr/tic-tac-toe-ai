<?php

namespace AirPetr\TicTacToeAi\Classes;

use Exception;

class ConfigValidator
{
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
            throw new Exception('Wrong board size');
        }
    }
}
