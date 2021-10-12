<?php

use AirPetr\TicTacToeAi\Board;
use PHPUnit\Framework\TestCase;

final class BoardTest extends TestCase
{
    public function testInitialization(): void
    {
        $this->assertInstanceOf(Board::class, Board::createByArrayTable([]));
        $this->assertInstanceOf(Board::class, Board::createByPlainArray([]));
        $this->assertInstanceOf(Board::class, Board::createByString(''));
    }
}
