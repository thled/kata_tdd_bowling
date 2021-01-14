<?php

declare(strict_types=1);

namespace App\Tests;

use App\Game;

function rollMany(Game $bowling, int $rolls, int $pins): void {
    for ($roll = 0; $roll < $rolls; $roll++) {
        $bowling->roll($pins);
    }
}

function rollSpare(Game $bowling): void {
    $bowling->roll(5);
    $bowling->roll(5);
}

function rollStrike(Game $bowling): void {
    $bowling->roll(10);
}

it('plays a gutter game', function() {
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
    rollSpare($bowling);
    $bowling->roll(1);
    rollMany($bowling, 17, 0);

    expect($bowling->score())->toEqual(10+1+1);
});

it('rolls no spare between frames', function () {
    $bowling = new Game();
    $bowling->roll(0);
    rollSpare($bowling);
    $bowling->roll(1);
    rollMany($bowling, 16, 0);

    expect($bowling->score())->toEqual(10+1);
});

it('rolls a strike', function () {
    $bowling = new Game();
    rollStrike($bowling);
    $bowling->roll(1);
    $bowling->roll(2);
    rollMany($bowling, 16, 0);

    expect($bowling->score())->toEqual(10+3+1+2);
});

it('rolls no strike if second ball', function () {
    $bowling = new Game();
    $bowling->roll(0);
    rollStrike($bowling);
    $bowling->roll(1);
    $bowling->roll(2);
    rollMany($bowling, 16, 0);

    expect($bowling->score())->toEqual(10+1+2);
});

it('rolls all spare', function() {
    $bowling = new Game();
    rollMany($bowling, 21, 5);

    expect($bowling->score())->toEqual(20*5+10*5);
});

it('plays a perfect game', function() {
    $bowling = new Game();
    rollMany($bowling, 12, 10);

    expect($bowling->score())->toEqual(300);
});
