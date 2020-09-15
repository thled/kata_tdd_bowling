# Kata: TDD Bowling

[![MIT License][license-badge]][license]

## Requirements

- [Docker][docker]
- [Docker-Compose][docker-compose]

## Installation

1. Clone this repository: `$ git clone git@github.com:thled/kata_tdd_bowling`
1. Change to PHP project directory: `$ cd kata_tdd_bowling/php`
1. Build and start the docker containers: `$ docker-compose up -d`
1. Initialize the app: `$ docker-compose exec app composer bootstrap`

## Usage

- SSH into container: `$ docker-compose exec app ash`
- Run tests in container: `$ composer test`
- Watch tests in container: `$ composer test:watch`

## Goal

### Bowling Rules

- The game consists of 10 frames.
  - In each frame the player has two rolls to knock down 10 pins.
  - The score for the frame is the total number of pins knocked down, plus bonuses for strikes and spares.
- A spare is when the player knocks down all 10 pins in two rolls.
  - The bonus for that frame is the number of pins knocked down by the next roll.
- A strike is when the player knocks down all 10 pins on his first roll.
  - The frame is then completed with a single roll.
  - The bonus for that frame is the value of the next two rolls.
- In the tenth frame a player who rolls a spare or strike is allowed to roll the extra balls to complete the frame.
  - However no more than three balls can be rolled in tenth frame.

### Implementation

Write a class `Game` that has two methods:

- `roll(int $pins): void` is called each time the player rolls a ball.
The argument is the number of pins knocked down.
- `score(): int` returns the total score for that game.

[license-badge]: https://img.shields.io/badge/license-MIT-blue.svg
[license]: ./LICENSE
[docker]: https://docs.docker.com/install/
[docker-compose]: https://docs.docker.com/compose/install/

