export class Bowling {
    private rolls: Array<number> = []

    public score(): number {
        let score = 0

        for (
            let frame = 0, firstInFrame = 0;
            frame < 10;
            frame++, firstInFrame += 2
        ) {
            score += this.frameScore(firstInFrame)

            if (this.isStrike(firstInFrame)) {
                score += this.strikeBonus(firstInFrame)
                firstInFrame--
            } else if (this.isSpare(firstInFrame))
                score += this.spareBonus(firstInFrame)
        }

        return score
    }

    private strikeBonus(firstInFrame: number): number {
        return this.rolls[firstInFrame + 1] + this.rolls[firstInFrame + 2]
    }

    private isStrike(roll: number): boolean {
        return this.rolls[roll] === 10
    }

    private frameScore(firstInFrame: number) {
        if (this.isStrike(firstInFrame)) return this.rolls[firstInFrame]

        return this.rolls[firstInFrame] + this.rolls[firstInFrame + 1]
    }

    private spareBonus(roll: number) {
        return this.rolls[roll + 2]
    }

    private isSpare(roll: number): boolean {
        return this.rolls[roll] + this.rolls[roll + 1] === 10
    }

    public roll(pins: number) {
        this.rolls.push(pins)
    }
}
