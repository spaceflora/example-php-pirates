<?php

namespace Pirates\Entity;

/**
 * Class Tile
 */
class Tile
{
    /** @var int */
    private int $coins;
    /** @var Pos */
    private Pos $pos;

    /**
     * Tile constructor.
     *
     * @param Pos $pos
     */
    public function __construct(Pos $pos)
    {
        $this->coins = 1;
        $this->pos = $pos;
    }

    /**
     * @return int
     */
    public function getCoins(): int
    {
        return $this->coins;
    }

    /**
     * @param int $coins
     */
    public function setCoins(int $coins): void
    {
        $this->coins = $coins;
    }

    /**
     * @return Pos
     */
    public function getPos(): Pos
    {
        return $this->pos;
    }
}
