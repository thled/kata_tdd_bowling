<?php

declare(strict_types=1);

namespace App\Tests;

use App\Game;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    private Game $bowling;

    /** @test */
    public function nothing(): void
    {
        self::assertTrue(true);
    }

    private function rollMany(int $amount, int $pins): void
    {
        for ($i = 0; $i < $amount; $i++)
            $this->bowling->roll($pins);
    }

    private function rollSpare(): void
    {
        $this->bowling->roll(5);
        $this->bowling->roll(5);
    }

    private function rollStrike(): void
    {
        $this->bowling->roll(10);
    }

    public function setUp(): void
    {
        $this->bowling = new Game();
    }

    /** @test */
    public function createBowlingGame(): void
    {
        $bowling = new Game();

        self::assertInstanceOf(Game::class, $bowling);
    }

    /** @test */
    public function rollBall(): void
    {
        $this->bowling->roll(0);
    }

    /** @test */
    public function gutterGame(): void
    {
        $this->rollMany(20, 0);

        self::assertSame(0, $this->bowling->score());
    }

    /** @test */
    public function rollAllOne(): void
    {
        $this->rollMany(20, 1);

        self::assertSame(20, $this->bowling->score());
    }

    /** @test */
    public function rollOneSpare(): void
    {
        $this->rollSpare();
        $this->bowling->roll(1);
        $this->rollMany(17, 0);

        self::assertSame(10+1+1, $this->bowling->score());
    }

    /** @test */
    public function noSpareBetweenFrames(): void
    {
        $this->bowling->roll(0);
        $this->rollSpare();
        $this->bowling->roll(1);
        $this->rollMany(16, 0);

        self::assertSame(10+1, $this->bowling->score());
    }

    /** @test */
    public function rollAllSpares(): void
    {
        $this->rollMany(21, 5);

        self::assertSame(10*10+10*5, $this->bowling->score());
    }

    /** @test */
    public function rollOneStrike(): void
    {
        $this->rollStrike();
        $this->bowling->roll(1);
        $this->bowling->roll(1);
        $this->rollMany(16, 0);

        self::assertSame(10+2+1+1, $this->bowling->score());
    }

    /** @test */
    public function noStrikeIfSecondBallButSpare(): void
    {
        $this->bowling->roll(0);
        $this->rollStrike();
        $this->bowling->roll(1);
        $this->bowling->roll(1);
        $this->rollMany(16, 0);

        self::assertSame(10+1+1+1, $this->bowling->score());
    }

    /** @test */
    public function perfectGame(): void
    {
        $this->rollMany(12, 10);

        self::assertSame(300, $this->bowling->score());
    }
}
