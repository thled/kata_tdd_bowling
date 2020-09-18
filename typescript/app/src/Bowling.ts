export class Bowling {
    private rolls: Array<number> = []

    public roll(pins: number): void {
        this.rolls.push(pins)
    }

    public score(): number {
        let score: number = 0

        for (
            let frame: number = 0, firstInFrame: number = 0;
            frame < 10;
            frame++, firstInFrame += 2
        ) {
            score += this.frameScore(firstInFrame)

            if (this.isSpare(firstInFrame))
                score += this.spareBonus(firstInFrame)

            if (this.isStrike(firstInFrame)) {
                score += this.strikeBonus(firstInFrame)

                firstInFrame--
            }
        }

        return score
    }

    private strikeBonus(firstInFrame: number): number {
        return this.rolls[firstInFrame + 1] + this.rolls[firstInFrame + 2]
    }

    private isStrike(firstInFrame: number): boolean {
        return this.rolls[firstInFrame] === 10
    }

    private spareBonus(firstInFrame: number): number {
        return this.rolls[firstInFrame + 2]
    }

    private isSpare(roll: number): boolean {
        return this.rolls[roll] + this.rolls[roll + 1] === 10
    }

    private frameScore(firstInFrame: number): number {
        if (this.isStrike(firstInFrame)) return this.rolls[firstInFrame]

        return this.rolls[firstInFrame] + this.rolls[firstInFrame + 1]
    }
}

