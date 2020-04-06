<?php

namespace Pirates\Entity;

/**
 * Class Pos
 */
class Pos
{
    /** @var int */
    private int $x;
    /** @var int */
    private int $y;

    /**
     * Pos constructor.
     *
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}
