import { Bowling } from '../src/Bowling'

describe('Bowling', () => {
    let bowling: Bowling

    beforeEach(() => {
        bowling = new Bowling()
    })

    it('nothing', () => {
        expect(true).toBe(true)
    })

    it('create bowling game', () => {
        const game = new Bowling()
        expect(game).toBeInstanceOf(Bowling)
    })

    it('roll a ball', () => {
        bowling.roll(0)
    })

    it('gutter game', () => {
        rollMany(20, 0)

        expect(bowling.totalScore()).toBe(0)
    })

    it('all ones', () => {
        rollMany(20, 1)

        expect(bowling.totalScore()).toBe(20)
    })

    function rollMany(rolls: number, pins: number): void {
        for (let roll = 0; roll < rolls; roll++) bowling.roll(pins)
    }
})
