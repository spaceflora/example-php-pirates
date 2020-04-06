<?php

namespace Pirates\Domain\Service;

use Pirates\Entity\Map;
use Pirates\Entity\Pos;
use Pirates\Entity\Tile;

/**
 * Class MapDomainService
 */
class MapDomainService
{
    /**
     * @param int $mapSize
     *
     * @return Map
     */
    public function generate(int $mapSize): Map
    {
        $minPos = new Pos(0, 0);
        $maxPos = new Pos($mapSize - 1, $mapSize - 1);
        $tiles = [];

        for ($x = 0; $x < $mapSize; $x++) {
            for ($y = 0; $y < $mapSize; $y++) {
                $pos = new Pos($x, $y);
                $tiles[] = new Tile($pos);
            }
        }

        return new Map($minPos, $maxPos, $tiles);
    }


}
