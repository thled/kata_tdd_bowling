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

        expect(bowling.score()).toBe(0)
    })

    it('all ones', () => {
        rollMany(20, 1)

        expect(bowling.score()).toBe(20)
    })

    it('spare', () => {
        rollSpare()
        rollMany(18, 0)

        expect(bowling.score()).toBe(10)
    })

    it('spare with bonus', () => {
        rollSpare()
        bowling.roll(1)
        rollMany(17, 0)

        expect(bowling.score()).toBe(10 + 1 + 1)
    })

    it('no spare between frames', () => {
        bowling.roll(0)
        rollSpare()
        bowling.roll(1)
        rollMany(16, 0)

        expect(bowling.score()).toBe(10 + 1)
    })

    it('strike', () => {
        rollStrike()
        rollMany(18, 0)

        expect(bowling.score()).toBe(10)
    })

    it('strike with bonus', () => {
        rollStrike()
        bowling.roll(1)
        bowling.roll(1)
        rollMany(16, 0)

        expect(bowling.score()).toBe(10 + 2 + 1 + 1)
    })

    it('no strike if second roll in frame', () => {
        bowling.roll(0)
        rollStrike()
        bowling.roll(1)
        bowling.roll(1)
        rollMany(16, 0)

        expect(bowling.score()).toBe(10 + 1 + 1 + 1)
    })

    it('perfect game', () => {
        rollMany(12, 10)

        expect(bowling.score()).toBe(300)
    })

    function rollMany(rolls: number, pins: number): void {
        for (let roll = 0; roll < rolls; roll++) bowling.roll(pins)
    }

    function rollSpare(): void {
        bowling.roll(5)
        bowling.roll(5)
    }

    function rollStrike(): void {
        bowling.roll(10)
    }
})
