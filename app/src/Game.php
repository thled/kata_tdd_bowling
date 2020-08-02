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
        foreach ($this->rolls as $roll => $pins) {
            $score += $pins;
            $score += $this->getBonus($roll);
        }

        return $score;
    }

    private function isFrameComplete(int $roll): bool
    {
        return $roll % 2 !== 0;
    }

    private function getBonus(int $roll): int
    {
        if ($this->isStrike($roll)) {
            return $this->getNext2RollsPins($roll);
        }

        if ($this->isSpare($roll)) {
            return $this->getNextRollPins($roll);
        }

        return 0;
    }

    private function isSpare(int $roll): bool
    {
        if (!$this->isFrameComplete($roll)) {
            return false;
        }

        return ($this->rolls[$roll - 1] + $this->rolls[$roll]) === 10;
    }
    
    private function getNextRollPins(int $roll): int
    {
        if (!$this->existsNextRoll($roll)) {
            return 0;
        }

        return $this->rolls[$roll + 1];
    }

    private function existsNextRoll(int $roll): bool
    {
        return array_key_exists($roll + 1, $this->rolls);
    }

    private function isStrike(int $roll): bool
    {
        if (!$this->isFrameComplete($roll)) {
            return false;
        }

        return $this->rolls[$roll - 1] === 10;
    }

    private function getNext2RollsPins(int $roll): int
    {
        $pins = $this->getNextRollPins($roll);
        $pins += $this->getRollPinsAfterNextRoll($roll);

        return $pins;
    }

    private function getRollPinsAfterNextRoll(int $roll): int
    {
        if (!$this->existsRollAfterNextRoll($roll)) {
            return 0;
        }

        return $this->rolls[$roll + 2];
    }

    private function existsRollAfterNextRoll(int $roll): bool
    {
        return array_key_exists($roll + 2, $this->rolls);
    }
}
