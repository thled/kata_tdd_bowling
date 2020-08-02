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
        $game = $this->createGame();

        self::assertInstanceOf(Game::class, $game);
    }

    /** @dataProvider providePins */
    public function testRollXPins(int $pins, int $expectedScore): void
    {
        $game = $this->createGame();

        $game->roll($pins);

        self::assertSame($expectedScore, $game->score());
    }

    /** @return array<string, array<int, int>> */
    public function providePins(): array
    {
        return [
            'roll 0 pins' => [0, 0],
            'roll 1 pin' => [1, 1],
            'roll 2 pins' => [2, 2],
        ];
    }

    public function testShowScore(): void
    {
        $game = $this->createGame();

        $score = $game->score();

        self::assertSame(0, $score);
    }

    /** @dataProvider provideFrameRolls */
    public function testPlayFrame(
        int $firstPins,
        int $secondPins,
        int $expectedScore
    ): void {
        $game = $this->createGame();

        $game->roll($firstPins);
        $game->roll($secondPins);

        self::assertSame($expectedScore, $game->score());
    }

    /** @return array<string, array<int, int>> */
    public function provideFrameRolls(): array
    {
        return [
            'gutter frame' => [0, 0, 0],
            'roll 0 then 1' => [0, 1, 1],
            'roll 1 then 1' => [1, 1, 2],
            'roll 1 then 2' => [1, 2, 3],
            'roll 2 then 1' => [2, 1, 3],
            'roll 2 then 2' => [2, 2, 4],
        ];
    }

    public function testSpareBonus(): void
    {
        $game = $this->createGame();

        $game->roll(5);
        $game->roll(5);
        $game->roll(1);

        self::assertSame(12, $game->score());
    }

    public function testStrikeBonus(): void
    {
        $game = $this->createGame();

        $game->roll(10);
        $game->roll(1);
        $game->roll(1);

        self::assertSame(14, $game->score());
    }

    private function createGame(): Game
    {
        return new Game();
    }
}
