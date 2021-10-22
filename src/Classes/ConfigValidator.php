<?php

namespace AirPetr\TicTacToeAi\Classes;

use Exception;

/**
 * Board config validator.
 */
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
        $validator = new self();
        $validator->validateSize(count(array_merge(...$config)));

        foreach ($config as $row) {
            foreach ($row as $symbol) {
                $validator->validateSymbol($symbol);
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
        $validator = new self();
        $validator->validateSize(count($config));

        foreach ($config as $symbol) {
            $validator->validateSymbol($symbol);
        }
    }

    /**
     * Validate string config.
     *
     * @param string $config
     *
     * @throws Exception
     */
    public static function validateString(string $config): void
    {
        $validator = new self();
        $validator->validateSize(strlen($config));

        foreach (str_split($config) as $symbol) {
            $validator->validateSymbol($symbol);
        }
    }

    /**
     * Validate size.
     *
     * @param int $len
     *
     * @throws Exception
     */
    protected function validateSize(int $len): void
    {
        if ($len !== 9) {
            throw new Exception('Wrong board size');
        }
    }

    /**
     * Validate symbol.
     *
     * @param $symbol
     *
     * @throws Exception
     */
    protected function validateSymbol($symbol): void
    {
        if (!in_array($symbol, ['_', 'X', 'O'])) {
            throw new Exception('Wrong board symbol');
        }
    }
}
