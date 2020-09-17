export class Bowling {
    private score: number = 0

    totalScore(): number {
        return this.score
    }

    roll(pins: number): void {
        this.score += pins
    }
}
