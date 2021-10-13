<?php

namespace AirPetr\TicTacToeAi\Classes;

use AirPetr\TicTacToeAi\Board;

/**
 * Board class factory.
 */
class BoardFactory
{
    /**
     * Create board by array table.
     *
     * @param array $config
     *
     * @return Board
     */
    public static function createByArrayTable(array $config): Board
    {
        $board = new Board();

        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++) {
                $board->put($config[$row][$col], $row, $col);
            }
        }

        return $board;
    }

    /**
     * Create board by plain array.
     *
     * @param array $config
     *
     * @return Board
     */
    public static function createByPlainArray(array $config): Board
    {
        $board = new Board();

        $i = 0;
        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++) {
                $board->put($config[$i], $row, $col);
                $i++;
            }
        }

        return $board;
    }

    /**
     * Create board by data string.
     *
     * @param string $config
     *
     * @return Board
     */
    public static function createByString(string $config): Board
    {
        return BoardFactory::createByPlainArray(str_split($config));
    }
}
