<?php

namespace AirPetr\TicTacToeAi;

use AirPetr\TicTacToeAi\Classes\BoardFactory;

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
            ['_', '_', '_'],
            ['_', '_', '_'],
            ['_', '_', '_'],
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
        return BoardFactory::createByArrayTable($config);
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
        return BoardFactory::createByPlainArray($config);
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
        return BoardFactory::createByString($config);
    }

    /**
     * Place mark on a board.
     *
     * @param string $mark
     * @param int $row
     * @param int $col
     */
    public function put(string $mark, int $row, int $col): void
    {
        $this->cells[$row][$col] = $mark;
    }

    /**
     * Return array table representation of a board.
     *
     * @return array
     */
    public function toArrayTable(): array
    {
        return $this->cells;
    }

    /**
     * Return plain array representation of a board.
     *
     * @return array
     */
    public function toPlainArray(): array
    {
        return array_merge(...$this->cells);
    }

    /**
     * Return string representation of a board.
     *
     * @return string
     */
    public function toString(): string
    {
        return implode($this->toPlainArray());
    }

    /**
     * Return copy of the board.
     *
     * @return $this
     */
    public function copy(): self
    {
        return self::createByArrayTable($this->toArrayTable());
    }
}
