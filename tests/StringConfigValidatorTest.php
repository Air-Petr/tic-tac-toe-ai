<?php

use AirPetr\TicTacToeAi\Board;
use PHPUnit\Framework\TestCase;

/**
 * Tests for string config validator.
 */
final class StringConfigValidatorTest extends TestCase
{
    /**
     * Test normal string size.
     */
    public function testStringNormalSize(): void
    {
        $config = '_________';

        Board::createByString($config);
        $this->assertTrue(true);
    }

    /**
     * Test wrong string size.
     */
    public function testStringWrongSize(): void
    {
        $config = '';

        $this->expectException(Exception::class);
        Board::createByString($config);
    }
    /**
     * Test wrong string size.
     */
    public function testStringWrongSymbols(): void
    {
        $config = 'f________';

        $this->expectException(Exception::class);
        Board::createByString($config);
    }
}
