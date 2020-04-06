<?php

namespace Pirates\Entity;

/**
 * Class Pirate
 */
class Pirate
{
    /** @var int */
    private int $coinsInHand;
    /** @var int */
    private int $coinsInShip;
    /** @var Pos */
    private Pos $currentPos;
    /** @var int */
    private int $id;
    /** @var bool */
    private bool $isHunting;
    /** @var Pos */
    private Pos $lastPos;
    /** @var Pos */
    private Pos $shipPos;

    /**
     * Tile constructor.
     *
     * @param int $id
     * @param Pos $shipPos
     */
    public function __construct(int $id, Pos $shipPos)
    {
        $this->coinsInHand = 0;
        $this->coinsInShip = 0;
        $this->currentPos = $shipPos;
        $this->id = $id;
        $this->isHunting = true;
        $this->lastPos = $shipPos;
        $this->shipPos = $shipPos;
    }

    /**
     * @return int
     */
    public function getCoinsInHand(): int
    {
        return $this->coinsInHand;
    }

    /**
     * @param int $coinsInHand
     */
    public function setCoinsInHand(int $coinsInHand): void
    {
        $this->coinsInHand = $coinsInHand;
    }

    /**
     * @return int
     */
    public function getCoinsInShip(): int
    {
        return $this->coinsInShip;
    }

    /**
     * @param int $coinsInShip
     */
    public function setCoinsInShip(int $coinsInShip): void
    {
        $this->coinsInShip = $coinsInShip;
    }

    /**
     * @return Pos
     */
    public function getCurrentPos(): Pos
    {
        return $this->currentPos;
    }

    /**
     * @param Pos $currentPos
     */
    public function setCurrentPos(Pos $currentPos): void
    {
        $this->currentPos = $currentPos;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isHunting(): bool
    {
        return $this->isHunting;
    }

    /**
     * @param bool $isHunting
     */
    public function setIsHunting(bool $isHunting): void
    {
        $this->isHunting = $isHunting;
    }

    /**
     * @return Pos
     */
    public function getLastPos(): Pos
    {
        return $this->lastPos;
    }

    /**
     * @param Pos $lastPos
     */
    public function setLastPos(Pos $lastPos): void
    {
        $this->lastPos = $lastPos;
    }

    /**
     * @return Pos
     */
    public function getShipPos(): Pos
    {
        return $this->shipPos;
    }
}
