<?php

use AirPetr\TicTacToeAi\Board;
use PHPUnit\Framework\TestCase;
use AirPetr\TicTacToeAi\Player;

/**
 * Tests for Player class.
 */
final class PlayerTest extends TestCase
{
    /**
     * Test player initialization.
     */
    public function testInitialization(): void
    {
        $this->assertInstanceOf(Player::class, Player::easy());
        $this->assertInstanceOf(Player::class, Player::normal());
        $this->assertInstanceOf(Player::class, Player::hard());
    }

    /**
     * Test that move changes the board.
     */
    public function testMoveChangesBoard(): void
    {
        $board = Board::createByString('__X__O__X');
        $player = new Player();
        $nextBoard = $player->placeMark('O', $board);

        $this->assertInstanceOf(Board::class, $nextBoard);
        $this->assertNotSameSize(array_keys($board->toPlainArray(), '_'), array_keys($nextBoard->toPlainArray(), '_'));
    }
}
