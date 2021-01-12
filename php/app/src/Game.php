<?php

declare(strict_types=1);

namespace App;

final class Game
{
    private array $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $points = 0;
        for ($frame = 0, $roll = 0; $frame < 10; $frame++) {
            $points += $this->rolls[$roll];
            $points += $this->rolls[$roll+1];

            if ($this->isStrike($roll)) {
                $points += $this->rolls[$roll+2];
                $roll -= 1;
            } elseif ($this->isSpare($roll)) {
                $points += $this->rolls[$roll+2];
            }
            
            $roll += 2;
        }

        return $points;
    }

    private function isSpare(int $roll): bool
    {
        return $this->rolls[$roll] + $this->rolls[$roll+1] === 10;
    }

    private function isStrike(int $roll): bool
    {
        return $this->rolls[$roll] === 10;
    }
}
