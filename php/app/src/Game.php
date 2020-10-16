<?php

namespace App;

class Game
{
    private array $rolls = [];

    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $score = 0;

        for ($frame = 0, $roll = 0; $frame < 10; $frame++) {
            $score += $this->frameScore($roll);

            if ($this->isStrike($roll)) {
                $score += $this->strikeBonus($roll);
                $roll--;
            }
            elseif ($this->isSpare($roll))
                $score += $this->spareBonus($roll);

            $roll += 2;
        }

        return $score;
    }

    private function isSpare(int $roll): bool
    {
        return $this->rolls[$roll] + $this->rolls[$roll+1] === 10;
    }

    private function spareBonus(int $roll): int
    {
        return $this->rolls[$roll+2];
    }

    private function frameScore(int $roll): int
    {
        if ($this->isStrike($roll))
            return 10;

        return $this->rolls[$roll] + $this->rolls[$roll+1];
    }

    private function isStrike(int $roll): bool
    {
        return $this->rolls[$roll] === 10;
    }

    private function strikeBonus(int $roll): int
    {
        return $this->rolls[$roll+1] + $this->rolls[$roll+2];
    }
}
