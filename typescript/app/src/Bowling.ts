export class Bowling {
    private _score = 0

    score(): number {
        return this._score
    }

    roll(pins: number) {
        this._score += pins
    }
}
