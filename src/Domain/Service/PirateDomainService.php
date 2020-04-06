<?php

namespace Pirates\Domain\Service;

use Pirates\Entity\Map;
use Pirates\Entity\Pirate;
use Pirates\Entity\Pos;
use Pirates\Helper\PosHelper;

/**
 * Class PirateDomainService
 */
class PirateDomainService
{
    /** @var PosHelper */
    private PosHelper $posHelper;

    /**
     * PirateDomainService constructor.
     */
    public function __construct()
    {
        $this->posHelper = new PosHelper();
    }

    /**
     * @param int $count
     *
     * @return Pirate[]
     */
    public function generate(int $count): array
    {
        $players = [];

        for ($i = 0; $i < $count; $i++) {
            $pos = new Pos(-1, $i);
            $players[] = new Pirate($i + 1, $pos);
        }

        return $players;
    }

    public function move(Pirate $pirate, Map $map): void
    {
        $nextPos = $this->getNextPos($pirate, $map);

        $pirate->setLastPos($pirate->getCurrentPos());
        $pirate->setCurrentPos($nextPos);
    }

    private function getNextPos(Pirate $pirate, Map $map): Pos
    {
        $positions = [];
        $this->addValidPos($positions, new Pos(-1, 0), $pirate, $map);

        if (true === $pirate->isHunting()) {
            $this->addValidPos($positions, new Pos(1, 0), $pirate, $map);
            $this->addValidPos($positions, new Pos(0, -1), $pirate, $map);
            $this->addValidPos($positions, new Pos(0, 1), $pirate, $map);
        } else {
            if ($pirate->getCurrentPos()->getY() !== $pirate->getShipPos()->getY()) {
                $relativeY = $pirate->getCurrentPos()->getY() < $pirate->getShipPos()->getY() ? 1 : -1;
                $this->addValidPos($positions, new Pos(0, $relativeY), $pirate, $map);
            }
        }

        return $positions[mt_rand(0, count($positions) - 1)];
    }

    /**
     * @param array $positions
     * @param Pos $relativePos
     * @param Pirate $pirate
     * @param Map $map
     */
    private function addValidPos(array &$positions, Pos $relativePos, Pirate $pirate, Map $map): void
    {
        $newPos = $this->posHelper->sum($pirate->getCurrentPos(), $relativePos);

        if (
            (
                true === $pirate->isHunting() &&
                true === $this->posHelper->isWithin($newPos, $map->getMinPos(), $map->getMaxPos()) &&
                (
                    false === $this->posHelper->isEqual($newPos, $pirate->getLastPos()) ||
                    $this->posHelper->isEqual($pirate->getCurrentPos(), $pirate->getShipPos())
                )
            ) ||
            (
                false === $pirate->isHunting() &&
                (
                    true === $this->posHelper->isWithin($newPos, $map->getMinPos(), $map->getMaxPos()) ||
                    $this->posHelper->isEqual($newPos, $pirate->getShipPos())
                )
            )
        ) {
            $positions[] = $newPos;
        }
    }
}
