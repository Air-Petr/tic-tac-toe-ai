<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use AirPetr\TicTacToeAi\Hello;

final class FirstTest extends TestCase
{
    public function testPushAndPop(): void
    {
        $this->assertSame('test', Hello::test());
    }
}