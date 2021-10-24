<?php

use AirPetr\TicTacToeAi\Player;
use AirPetr\TicTacToeAi\Board;
use PHPUnit\Framework\TestCase;

class MinimaxTest extends TestCase
{
    /**
     * Test win move 1.
     *
     * @throws Exception
     */
    public function testWinMove1(): void
    {
        $player = Player::hard();
        $newBoard = $player->placeMark('X', Board::createByString('XOXOOX___'));

        $this->assertEquals('XOXOOX__X', $newBoard->toString());
    }

    /**
     * Test win move 2.
     *
     * @throws Exception
     */
    public function testWinMove2(): void
    {
        $player = Player::hard();
        $newBoard = $player->placeMark('X', Board::createByString('O_XX__XOO'));

        $this->assertEquals('O_XXX_XOO', $newBoard->toString());
    }

    /**
     * Test win move 3.
     *
     * @throws Exception
     */
    public function testWinMove3(): void
    {
        $player = Player::hard();
        $newBoard = $player->placeMark('O', Board::createByString('OXXX__XOO'));

        $this->assertEquals('OXXXO_XOO', $newBoard->toString());
    }

    /**
     * Test some move 1.
     *
     * @throws Exception
     */
    public function testSomeMove1(): void
    {
        $player = Player::hard();
        $newBoard = $player->placeMark('O', Board::createByString('_X___XOOX'));

        $this->assertEquals('_XO__XOOX', $newBoard->toString());
    }

    /**
     * Test some move 2.
     *
     * @throws Exception
     */
    public function testSomeMove2(): void
    {
        $player = Player::hard();
        $newBoard = $player->placeMark('O', Board::createByString('__OXOXX_O'));

        $this->assertEquals('O_OXOXX_O', $newBoard->toString());
    }

    /**
     * Test some move 3.
     *
     * @throws Exception
     */
    public function testSomeMove3(): void
    {
        $player = Player::hard();
        $newBoard = $player->placeMark('O', Board::createByString('_____X_OX'));

        $this->assertEquals('__O__X_OX', $newBoard->toString());
    }
}
