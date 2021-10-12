<?php

namespace AirPetr\TicTacToeAi;

/**
 * Game board.
 */
class Board
{
    /**
     * Board cells (game grid representation).
     *
     * @var array[]
     */
    private $cells;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cells = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];
    }

    /**
     * Create board by array table.
     *
     * @param array $config
     *
     * @return static
     */
    public static function createByArrayTable(array $config): self
    {
        $board = new self();
        return $board;
    }

    /**
     * Create board by plain array.
     *
     * @param array $config
     *
     * @return static
     */
    public static function createByPlainArray(array $config): self
    {
        $board = new self();
        return $board;
    }

    /**
     * Create board by data string.
     *
     * @param string $config
     *
     * @return static
     */
    public static function createByString(string $config): self
    {
        $board = new self();
        return $board;
    }
}
