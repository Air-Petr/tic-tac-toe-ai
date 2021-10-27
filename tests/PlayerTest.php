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
        $this->assertInstanceOf(Player::class, Player::normal());
        $this->assertInstanceOf(Player::class, Player::hard());
    }

    /**
     * Test that a move returns board.
     */
    public function testPlacingMarkReturnsBoard(): void
    {
        $board = new Board();
        $player = new Player();

        $this->assertInstanceOf(Board::class, $player->placeMark('O', $board));
    }

    /**
     * Test that move changes the board.
     */
    public function testMoveChangesBoard(): void
    {
        $board = new Board();
        $player = new Player();
        $nextBoard = $player->placeMark('O', $board);

        $this->assertNotSame($nextBoard->toString(), $board->toString());
    }

    /**
     * Test Exception throwing for full board.
     *
     * @throws Exception
     */
    public function testFullBoardException(): void
    {
        $player = new Player();
        $board = Board::createByString('XOXOXOXOX');

        $this->expectException(Exception::class);

        $player->placeMark('O', $board);
    }

    /**
     * Test wrong symbol given by user.
     *
     * @throws Exception
     */
    public function testWrongSymbol(): void
    {
        $player = new Player();
        $board = new Board();

        $this->expectException(Exception::class);

        $player->placeMark('f', $board);
    }

    /**
     * Test wrong order of move.
     *
     * @throws Exception
     */
    public function testWrongOrderOfMove(): void
    {
        $player = new Player();
        $board = Board::createByString('XOX______');

        $this->expectException(Exception::class);

        $player->placeMark('X', $board);
    }

}
