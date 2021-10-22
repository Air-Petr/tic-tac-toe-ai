<?php

use AirPetr\TicTacToeAi\Board;
use PHPUnit\Framework\TestCase;

/**
 * Tests for plain array config validator.
 */
final class PlainArrayValidatorTest extends TestCase
{
    /**
     * Test normal plain array size.
     */
    public function testPlainArrayNormalSize(): void
    {
        $config = ['_', '_', '_', '_', '_', '_', '_', '_', '_'];

        Board::createByPlainArray($config);
        $this->assertTrue(true);
    }

    /**
     * Test normal array table size.
     */
    public function testPlainArrayWrongSize(): void
    {
        $config = ['_'];

        $this->expectException(Exception::class);
        Board::createByPlainArray($config);
    }

    /**
     * Test wrong symbols in config.
     */
    public function testArrayTableWrongSymbols(): void
    {
        $config = ['f', '_', '_', '_', '_', '_', '_', '_', '_'];

        $this->expectException(Exception::class);
        Board::createByPlainArray($config);
    }
}
