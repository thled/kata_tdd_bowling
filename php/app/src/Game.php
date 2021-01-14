<?php

declare(strict_types=1);

namespace App;

final class Game
{
    /** @var array<int, int> $rolls */
    private array $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $points = 0;
        for ($frame = 0, $roll = 0; $frame < 10; $frame++, $roll += 2) {
            $points += $this->calcFramePins($roll);
            if ($this->isSpare($roll) || $this->isStrike($roll)) {
                $points += $this->getBonus($roll);
                if ($this->isStrike($roll)) {
                    $roll--;
                }
            }
        }

        return $points;
    }

    private function isSpare(int $roll): bool
    {
        return $this->rolls[$roll] !== 10 &&
            $this->rolls[$roll+1] !== 10 &&
            $this->rolls[$roll] + $this->rolls[$roll+1] === 10;
    }

    private function calcFramePins(int $roll): int
    {
        return $this->rolls[$roll] + $this->rolls[$roll+1];
    }

    private function getBonus(int $roll): int
    {
        return $this->rolls[$roll+2];
    }

    private function isStrike(int $roll): bool
    {
        return $this->rolls[$roll] === 10;
    }
}
