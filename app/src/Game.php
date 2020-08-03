<?php

declare(strict_types=1);

namespace App;

final class Game
{
    /** @var array<int, int> */
    private array $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $score = 0;
        foreach (array_keys($this->rolls) as $rollCount)
            $score += $this->calculateScoreForRoll($rollCount);

        return $score;
    }

    private function calculateScoreForRoll(int $rollCount): int
    {
        $rollScore = $this->rolls[$rollCount];
        if ($rollCount % 2 !== 0)
            $rollScore += $this->calulateSpareBonus($rollCount);

        return $rollScore;
    }

    private function calulateSpareBonus(int $rollCount): int
    {
        if ($this->rolls[$rollCount] + $this->rolls[$rollCount - 1] === 10)
            return $this->rolls[$rollCount + 1];

        return 0;
    }
}
