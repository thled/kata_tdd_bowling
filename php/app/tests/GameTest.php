<?php

declare(strict_types=1);

namespace App\Tests;

use App\Game;

it('works', function () {
    expect(true)->toBeTrue();
});

function rollMany(Game $bowling, int $rolls, int $pins): void
{
    for($i = 0; $i < $rolls; $i++) {
        $bowling->roll($pins);
    }
}

it('creates a bowling game', function () {
    $bowling = new Game();
    expect($bowling)->toBeInstanceOf(Game::class);
});

it('plays a gutter game', function () {
    $bowling = new Game();
    rollMany($bowling, 20, 0);

    expect($bowling->score())->toEqual(0);
});

it('rolls all 1s', function () {
    $bowling = new Game();
    rollMany($bowling, 20, 1);

    expect($bowling->score())->toEqual(20);
});

it('rolls all 2s', function () {
    $bowling = new Game();
    rollMany($bowling, 20, 2);

    expect($bowling->score())->toEqual(40);
});

it('rolls a spare', function () {
    $bowling = new Game();
    rollMany($bowling, 3, 5);
    rollMany($bowling, 17, 0);

    expect($bowling->score())->toEqual(3*5+5);
});

it('rolls no spare between frames', function () {
    $bowling = new Game();
    $bowling->roll(0);
    rollMany($bowling, 3, 5);
    rollMany($bowling, 16, 0);

    expect($bowling->score())->toEqual(3*5);
});

it('rolls a strike', function () {
    $bowling = new Game();
    $bowling->roll(10);
    $bowling->roll(1);
    $bowling->roll(1);
    rollMany($bowling, 16,0);

    expect($bowling->score())->toEqual(12+2);
});

it('rolls spare if second roll strikes', function () {
    $bowling = new Game();
    $bowling->roll(0);
    $bowling->roll(10);
    $bowling->roll(1);
    $bowling->roll(1);
    rollMany($bowling, 16, 0);

    expect($bowling->score())->toEqual(12 + 1);
});

it('rolls all spares', function () {
    $bowling = new Game();
    rollMany($bowling, 21, 5);

    expect($bowling->score())->toEqual(20*5+10*5);
});

it('plays a perfect game', function () {
    $bowling = new Game();
    rollMany($bowling, 12, 10);

    expect($bowling->score())->toEqual(300);
});
