<?php declare(strict_types=1);

namespace Pirates\Tests\Helper;

use PHPUnit\Framework\TestCase;
use Pirates\Entity\Pos;
use Pirates\Helper\PosHelper;

/**
 * Class PosHelperTest
 */
final class PosHelperTest extends TestCase
{
    public function testIsEqual(): void
    {
        $posHelper = new PosHelper();

        $this->assertTrue(
            $posHelper->isEqual(new Pos(0, 1), new Pos(0, 1))
        );
    }

    public function testIsNotEqual(): void
    {
        $posHelper = new PosHelper();

        $this->assertNotTrue(
            $posHelper->isEqual(new Pos(0, 0), new Pos(1, 1))
        );
    }

    public function testIsWithin(): void
    {
        $posHelper = new PosHelper();
        $minPos = new Pos(-1, -1);
        $maxPos = new Pos(1, 1);

        for ($i = $minPos->getX(); $i <= $maxPos->getX(); $i++) {
            $pos = new Pos($i, $i);

            $this->assertTrue(
                $posHelper->isWithin($pos, $minPos, $maxPos)
            );
        }
    }

    public function testIsNotWithin(): void
    {
        $posHelper = new PosHelper();
        $minPos = new Pos(-1, -1);
        $maxPos = new Pos(1, 1);

        $this->assertNotTrue(
            $posHelper->isWithin(new Pos(-2, -2), $minPos, $maxPos)
        );

        $this->assertNotTrue(
            $posHelper->isWithin(new Pos(2, 2), $minPos, $maxPos)
        );
    }

    public function testSum(): void
    {
        $posHelper = new PosHelper();

        for ($i = -1; $i <= 1; $i++) {
            $pos = new Pos($i, $i + 1);

            $posSum = $posHelper->sum($pos, $pos);

            $this->assertTrue($i + $i === $posSum->getX());
            $this->assertTrue($i + 1 + $i + 1 === $posSum->getY());
        }
    }
}
