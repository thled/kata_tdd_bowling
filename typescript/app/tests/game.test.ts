import {Bowling} from '../src/Bowling'

test('nothing', () => {
  expect(true).toBe(true)
})

test('create bowling game', () => {
    const game = new Bowling()
    expect(game).toBeInstanceOf(Bowling)
})
