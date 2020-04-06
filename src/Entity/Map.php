<?php

namespace Pirates\Entity;

/**
 * Class Map
 */
class Map
{
    /** @var Pos */
    private Pos $maxPos;
    /** @var Pos */
    private Pos $minPos;
    /** @var Tile[] */
    private array $tiles;

    /**
     * Map constructor.
     *
     * @param Pos $minPos
     * @param Pos $maxPos
     * @param Tile[] $tiles
     */
    public function __construct(Pos $minPos, Pos $maxPos, array $tiles)
    {
        $this->maxPos = $maxPos;
        $this->minPos = $minPos;
        $this->tiles = $tiles;
    }

    /**
     * @return Pos
     */
    public function getMinPos(): Pos
    {
        return $this->minPos;
    }

    /**
     * @return Pos
     */
    public function getMaxPos(): Pos
    {
        return $this->maxPos;
    }

    /**
     * @return Tile[]
     */
    public function getTiles(): array
    {
        return $this->tiles;
    }
}
