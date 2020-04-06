<?php

namespace Pirates\Helper;

use Pirates\Entity\Pos;

/**
 * Class PosHelper
 */
class PosHelper
{
    /**
     * @param Pos $pos1
     * @param Pos $pos2
     *
     * @return bool
     */
    public function isEqual(Pos $pos1, Pos $pos2): bool
    {
        if ($pos1->getX() === $pos2->getX() && $pos1->getY() === $pos2->getY()) {
            return true;
        }

        return false;
    }

    /**
     * @param Pos $pos
     * @param Pos $minPos
     * @param Pos $maxPos
     *
     * @return bool
     */
    public function isWithin(Pos $pos, Pos $minPos, Pos $maxPos): bool
    {
        if ($pos->getX() >= $minPos->getX() && $pos->getX() <= $maxPos->getX()) {
            if ($pos->getY() >= $minPos->getY() && $pos->getY() <= $maxPos->getY()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Pos $pos1
     * @param Pos $pos2
     *
     * @return Pos
     */
    public function sum(Pos $pos1, Pos $pos2): Pos
    {
        return new Pos($pos1->getX() + $pos2->getX(), $pos1->getY() + $pos2->getY());
    }
}
