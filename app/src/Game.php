<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\GameException;

final class Game
{
    private int $score = 0;

    public function roll(int $pins): void
    {
        if ($pins > 10)
            throw new GameException('You cannot roll more than 10 pins');

        $this->score += $pins;
    }

    public function score(): int
    {
        return $this->score;
    }
}
