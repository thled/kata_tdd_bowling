<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Game;
use PHPUnit\Framework\TestCase;

/** @covers Game */
final class GameTest extends TestCase
{
    /** @test */
    public function canCreateABowlingGame(): void
    {
        $bowling = new Game();

        self::assertInstanceOf(Game::class, $bowling);
    }
}
