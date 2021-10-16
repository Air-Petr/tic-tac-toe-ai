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

    public function testMove(): void
    {
        $board = new Board();
        $player = new Player();

        $this->assertInstanceOf(Board::class, $player->placeMark('foo', $board));
    }
}