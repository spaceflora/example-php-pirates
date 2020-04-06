<?php

namespace Pirates\Model;

use Pirates\Entity\Map;
use Pirates\Entity\Pirate;

/**
 * Class HuntModel
 */
class HuntModel
{
    /** @var string[] */
    private array $logLines;
    /** @var Map */
    private Map $map;
    /** @var Pirate[] */
    private array $pirates;

    /**
     * HuntModel constructor.
     *
     * @param Map $map
     * @param Pirate[] $pirates
     */
    public function __construct(Map $map, array $pirates)
    {
        $this->logLines = [];
        $this->map = $map;
        $this->pirates = $pirates;
    }

    /**
     * @param string $logLine
     */
    public function addLogLine(string $logLine): void
    {
        $this->logLines[] = $logLine;
    }

    /**
     * @return string[]
     */
    public function getLogLines(): array
    {
        return $this->logLines;
    }

    /**
     * @return Map
     */
    public function getMap(): Map
    {
        return $this->map;
    }

    /**
     * @return Pirate[]
     */
    public function getPirates(): array
    {
        return $this->pirates;
    }
}
