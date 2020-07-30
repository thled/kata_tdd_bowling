<?php

declare(strict_types=1);

namespace App\Tests;

use App\Exceptions\GameException;
use App\Game;
use PHPUnit\Framework\TestCase;

/** @covers Game */
final class GameTest extends TestCase
{
    public function testCreateGameInstance(): void
    {
        $sut = $this->createGame();

        self::assertInstanceOf(Game::class, $sut);
    }

    private function createGame(): Game
    {
        return new Game();
    }

    /** @dataProvider providePins */
    public function testRollXPins(int $pins, int $expectedScore): void
    {
        $sut = $this->createGame();

        $sut->roll($pins);

        self::assertSame($expectedScore, $sut->score());
    }

    public function providePins(): array
    {
        return [
            'roll 0 pins' => [0, 0],
            'roll 1 pin' => [1, 1],
            'roll many pins' => [2, 2],
        ];
    }

    public function testRollTooManyPins(): void
    {
        $sut = $this->createGame();

        $this->expectException(GameException::class);

        $sut->roll(11);
    }

    /** @dataProvider provideFame */
    public function testPlayFrame(int $pinsFirstRoll, int $pinsSecondRoll, int $expectedScore): void
    {
        $sut = $this->createGame();

        $sut->roll($pinsFirstRoll);
        $sut->roll($pinsSecondRoll);

        self::assertSame($expectedScore, $sut->score());
    }

    public function provideFame(): array
    {
        return [
            'gutter frame' => [0, 0, 0],
            'roll 0 then 1 pin' => [0, 1, 1],
            'roll 1 then 0 pins' => [1, 0, 1],
            'roll 1 then 1 pins' => [1, 1, 2],
        ];
    }

    public function testPlayGutterGame(): void
    {
        $sut = $this->createGame();

        for ($i = 0; $i < 20; $i++) {
            $sut->roll(0);
        }

        self::assertSame(0, $sut->score());
    }

    public function testPlayPerfectGame(): void
    {
        $sut = $this->createGame();

        for ($i = 0; $i < 12; $i++) {
            $sut->roll(10);
        }

        self::assertSame(300, $sut->score());
    }
}
