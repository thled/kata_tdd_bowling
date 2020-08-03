<?php

declare(strict_types=1);

namespace App\Tests;

use App\Game;
use PHPUnit\Framework\TestCase;

/** @covers Game */
final class GameTest extends TestCase
{
    /** @test */
    public function canCreateABowlingGame(): void
    {
        $bowling = $this->createBowlingGame();

        self::assertInstanceOf(Game::class, $bowling);
    }

    /**
     * @test
     * @testWith
     * [0, 0]
     * [1, 1]
     * [2, 2]
     */
    public function rollXPins(int $pins, int $expectedScore): void
    {
        $bowling = $this->createBowlingGame();

        $bowling->roll($pins);

        self::assertSame($expectedScore, $bowling->score());
    }

    /** @test */
    public function initialGameScoreIs0(): void
    {
        $bowling = $this->createBowlingGame();

        $score = $bowling->score();

        self::assertSame(0, $score);
    }

    /**
     * @test
     * @testWith
     * [0, 0]
     * [1, 20]
     * [2, 40]
     */
    public function rollAllX(int $pins, int $expectedScore): void
    {
        $bowling = $this->createBowlingGame();

        $this->roll20TimesXPins($bowling, $pins);

        self::assertSame($expectedScore, $bowling->score());
    }

    /** @test */
    public function bonusForSpare(): void
    {
        $bowling = $this->createBowlingGame();

        $bowling->roll(5);
        $bowling->roll(5);
        $bowling->roll(1);

        self::assertSame(12, $bowling->score());
    }

    /**
     * @test
     * @requires PHP = 6
     */
    public function rollAllSpares(): void
    {
        $bowling = $this->createBowlingGame();

        $this->roll20TimesXPins($bowling, 5);
        $bowling->roll(5);

        self::assertSame(150, $bowling->score());
    }

    private function createBowlingGame(): Game
    {
        return new Game();
    }

    private function roll20TimesXPins(Game $bowling, int $pins): void
    {
        for ($i = 0; $i < 20; $i++)
            $bowling->roll($pins);
    }
}
