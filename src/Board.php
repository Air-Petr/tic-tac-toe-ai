<?php

namespace AirPetr\TicTacToeAi;

use AirPetr\TicTacToeAi\Classes\BoardFactory;
use AirPetr\TicTacToeAi\Classes\ConfigValidator;

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
     * @throws \Exception
     */
    public static function createByArrayTable(array $config): self
    {
        ConfigValidator::validateArrayTable($config);
        return BoardFactory::createByArrayTable($config);
    }

    /**
     * Create board by plain array.
     *
     * @param array $config
     *
     * @return static
     * @throws \Exception
     */
    public static function createByPlainArray(array $config): self
    {
        ConfigValidator::validatePlainArray($config);
        return BoardFactory::createByPlainArray($config);
    }

    /**
     * Create board by data string.
     *
     * @param string $config
     *
     * @return static
     * @throws \Exception
     */
    public static function createByString(string $config): self
    {
        ConfigValidator::validateString($config);
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

    /**
     * Show whether a mark can be placed now.
     *
     * @param string $mark
     *
     * @return bool
     */
    public function validateMove(string $mark): bool
    {
        $playerMovesCount = 0;
        $opponentMovesCount = 0;

        foreach ($this->toPlainArray() as $cell) {
            if ($cell === '_') {
                continue;
            }

            if ($cell === $mark) {
                $playerMovesCount++;
            } else {
                $opponentMovesCount++;
            }
        }

        $diff = $opponentMovesCount - $playerMovesCount;
        return in_array($diff, [0, 1]);
    }

    /**
     * Return number of empty cells.
     *
     * @return int
     */
    public function countEmptyCells(): int
    {
        return count(array_filter($this->toPlainArray(), function ($cell) {
            return $cell === '_';
        }));
    }

    /**
     * Shows whether board has empty cells.
     *
     * @return bool
     */
    public function hasEmptyCells(): bool
    {
        return $this->countEmptyCells() > 0;
    }
}
