<?php

declare(strict_types=1);

namespace App\Tests;

use App\Game;
use PHPUnit\Framework\TestCase;

/** @covers Game */
final class GameTest extends TestCase
{
    public function testCreateGameInstance(): void
    {
        $sut = new Game();

        self::assertInstanceOf(Game::class, $sut);
    }
}
