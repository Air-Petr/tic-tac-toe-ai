<?php

use AirPetr\TicTacToeAi\Board;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Board validators.
 */
final class BoardValidatorsTest extends TestCase
{
    /**
     * Test normal array table size.
     */
    public function testArrayTableNormalSize(): void
    {
        $config = [
            ['_', '_', '_'],
            ['_', '_', '_'],
            ['_', '_', '_'],
        ];

        Board::createByArrayTable($config);
        $this->assertTrue(true);
    }

    /**
     * Test creation board of size 0.
     */
    public function testArrayTableSize0(): void
    {
        $badConfig = [];

        $this->expectException(Exception::class);
        Board::createByArrayTable($badConfig);

    }

    /**
     * Test creation board of size 16.
     */
    public function testArrayTableSize16(): void
    {
        $badConfig = [
            ['_', '_', '_'],
            ['_', '_', '_'],
            ['_', '_', '_'],
            ['_', '_', '_'],
        ];

        $this->expectException(Exception::class);
        Board::createByArrayTable($badConfig);

    }

    /**
     * Test creation board of size 13.
     */
    public function testArrayTableSize13(): void
    {
        $badConfig = [
            ['_', '_', '_'],
            ['_', '_', '_'],
            ['_', '_', '_', '_'],
        ];

        $this->expectException(Exception::class);
        Board::createByArrayTable($badConfig);

    }

    /**
     * Test creation board of size 10.
     */
    public function testArrayTableSize10(): void
    {
        $badConfig = [
            ['_', '_', '_'],
            ['_', '_', '_'],
            ['_', '_'],
        ];

        $this->expectException(Exception::class);
        Board::createByArrayTable($badConfig);
    }
}
