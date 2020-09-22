import { Bowling } from '../src/Bowling'

describe('Bowling', () => {
    it('nothing', () => {
        expect(true).toBe(true)
    })

    let bowling: Bowling

    beforeEach(() => {
        bowling = new Bowling()
    })

    it('can create Bowling game', () => {
        const game = new Bowling()

        expect(game).toBeInstanceOf(Bowling)
    })

    it('can roll a ball', () => {
        bowling.roll(0)
    })

    it('gutter game', () => {
        for (let roll = 0; roll < 20; roll++) bowling.roll(0)

        expect(bowling.score()).toBe(0)
    })

    it('all ones', () => {
        for (let roll = 0; roll < 20; roll++) bowling.roll(1)

        expect(bowling.score()).toBe(20)
    })
})
