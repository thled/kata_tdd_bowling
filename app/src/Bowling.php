<?php

declare(strict_types=1);

namespace App;

final class Bowling
{
    private const FRAME_COUNT = 10;
    private const ALL_PINS = 10;

    /** @var array<int, int> */
    private array $rolls = [];
    private int $firstInFrame = 0;

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $score = 0;

        for ($frame = 0; $frame < self::FRAME_COUNT; $frame++) {
            if ($this->isStrike()) {
                $score += self::ALL_PINS + $this->getStrikeBonus();
                $this->firstInFrame++;
            } elseif ($this->isSpare()) {
                $score += self::ALL_PINS + $this->getSpareBonus();
                $this->firstInFrame += 2;
            } else {
                $score += $this->calcPinsInFrame();
                $this->firstInFrame += 2;
            }
        }

        return $score;
    }

    private function isSpare(): bool
    {
        return $this->calcPinsInFrame($this->firstInFrame) === self::ALL_PINS;
    }

    private function calcPinsInFrame(): int
    {
        return $this->rolls[$this->firstInFrame] + $this->rolls[$this->firstInFrame + 1];
    }

    private function getSpareBonus(): int
    {
        return $this->rolls[$this->firstInFrame + 2];
    }

    private function isStrike(): bool
    {
        return $this->rolls[$this->firstInFrame] === self::ALL_PINS;
    }

    private function getStrikeBonus(): int
    {
        return $this->rolls[$this->firstInFrame + 1] + $this->rolls[$this->firstInFrame + 2];
    }
}
