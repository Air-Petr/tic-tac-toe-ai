<?php

use AirPetr\TicTacToeAi\Board;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Board class.
 */
final class BoardTest extends TestCase
{
    /**
     * Test board initialization.
     */
    public function testInitialization(): void
    {
        $this->assertInstanceOf(Board::class, Board::createByArrayTable($this->getDummyArrayTable()));
        $this->assertInstanceOf(Board::class, Board::createByPlainArray($this->getDummyPlainArray()));
        $this->assertInstanceOf(Board::class, Board::createByString($this->getDummyStringConfig()));
    }

    /**
     * Test board getters.
     */
    public function testBoardGetters(): void
    {
        $board = Board::createByArrayTable($this->getDummyArrayTable());
        $this->assertSame($this->getDummyArrayTable(), $board->toArrayTable());

        $board = Board::createByPlainArray($this->getDummyPlainArray());
        $this->assertSame($this->getDummyPlainArray(), $board->toPlainArray());

        $board = Board::createByString($this->getDummyStringConfig());
        $this->assertSame($this->getDummyStringConfig(), $board->toString());
    }

    /**
     * Test copy method.
     */
    public function testCopy(): void
    {
        $board = Board::createByArrayTable($this->getDummyArrayTable());
        $copy = $board->copy();

        $this->assertInstanceOf(Board::class, $copy);
        $this->assertNotSame($board, $copy);
        $this->assertSame($board->toString(), $copy->toString());
    }

    /**
     * Dummy array table.
     *
     * @return string[][]
     */
    protected function getDummyArrayTable(): array
    {
        return [
            ['X', '_', '_'],
            ['_', 'O', '_'],
            ['_', '_', 'X'],
        ];
    }

    /**
     * Dummy plain array.
     *
     * @return string[]
     */
    protected function getDummyPlainArray(): array
    {
        return ['X', '_', '_', '_', 'O', '_', '_', '_', 'X'];
    }

    /**
     * Dummy string config.
     *
     * @return string
     */
    protected function getDummyStringConfig(): string
    {
        return 'X___O___X';
    }
}
