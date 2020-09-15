<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Bowling;
use PHPUnit\Framework\TestCase;

/** @covers Bowling */
final class BowlingTest extends TestCase
{
    private Bowling $bowling;

    public function setUp(): void
    {
        parent::setUp();

        $this->bowling = new Bowling();
    }

    /** @test */
    public function canCreateABowlingGame(): void
    {
        self::assertInstanceOf(Bowling::class, $this->bowling);
    }

    /** @test */
    public function canRoll(): void
    {
        $this->bowling->roll(0);
    }

    /**
     * @test
     * @testWith
     * [0, 0]
     * [1, 20]
     * [2, 40]
     */
    public function allOne(int $pins, int $expectedScore): void
    {
        $this->rollMany(20, $pins);

        self::assertSame($expectedScore, $this->bowling->score());
    }

    /** @test */
    public function oneSpare(): void
    {
        $this->rollSpare();
        $this->bowling->roll(1);
        $this->rollMany(17, 0);

        self::assertSame(10 + 1 + 1, $this->bowling->score());
    }

    /** @test */
    public function noSpareBetweenFrames(): void
    {
        $this->bowling->roll(0);
        $this->rollSpare();
        $this->bowling->roll(1);
        $this->rollMany(16, 0);

        self::assertSame(11, $this->bowling->score());
    }

    /** @test */
    public function oneStrike(): void
    {
        $this->rollStrike();
        $this->bowling->roll(1);
        $this->bowling->roll(1);
        $this->rollMany(16, 0);

        self::assertSame(10 + 2 + 1 + 1, $this->bowling->score());
    }

    /** @test */
    public function allSpare(): void
    {
        $this->rollMany(21, 5);

        self::assertSame(100 + 45 + 5, $this->bowling->score());
    }

    /** @test */
    public function allStrike(): void
    {
        $this->rollMany(22, 10);

        self::assertSame(300, $this->bowling->score());
    }

    private function rollMany(int $rolls, int $pins): void
    {
        for ($roll = 0; $roll < $rolls; $roll++)
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
}
