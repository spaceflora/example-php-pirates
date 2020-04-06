<?php

namespace Pirates\Domain\Service;

use Pirates\Helper\PosHelper;
use Pirates\Model\HuntModel;

/**
 * Class HuntDomainService
 */
class HuntDomainService
{
    /** @var PosHelper */
    private PosHelper $posHelper;

    /**
     * HuntDomainService constructor.
     */
    public function __construct()
    {
        $this->posHelper = new PosHelper();
    }

    /**
     * @param HuntModel $huntModel
     */
    public function distributeCoins(HuntModel $huntModel): void
    {
        $this->distributeCoinsForPirates($huntModel);
        $this->distributeCoinsForTiles($huntModel);
    }

    /**
     * @param HuntModel $huntModel
     */
    private function distributeCoinsForPirates(HuntModel $huntModel): void
    {
        foreach ($huntModel->getPirates() as $pirate) {
            if (true === $this->posHelper->isEqual($pirate->getCurrentPos(), $pirate->getShipPos())) {
                $coinsToShip = $pirate->getCoinsInShip() + $pirate->getCoinsInHand();
                $pirate->setCoinsInShip($coinsToShip);
                $pirate->setCoinsInHand(0);
                $pirate->setIsHunting(true);

                $huntModel->addLogLine(sprintf(
                    'Pirate %d returns %d coins to the ship.',
                    $pirate->getId(),
                    $coinsToShip
                ));
            }
        }
    }

    /**
     * @param HuntModel $huntModel
     */
    private function distributeCoinsForTiles(HuntModel $huntModel): void
    {
        foreach ($huntModel->getMap()->getTiles() as $tile) {
            $pirateIndexes = [];
            $coins = 0;

            foreach ($huntModel->getPirates() as $piratesIndex => $pirate) {
                if (true === $this->posHelper->isEqual($pirate->getCurrentPos(), $tile->getPos())) {
                    $pirateIndexes[] = $piratesIndex;

                    $coins += $pirate->getCoinsInHand();
                    $pirate->setCoinsInHand(0);
                }
            }

            if (0 < count($pirateIndexes)) {
                $coins += $tile->getCoins();
                $tile->setCoins(0);

                if (0 < $coins) {
                    $pirateIndex = $pirateIndexes[mt_rand(0, count($pirateIndexes) - 1)];

                    $huntModel->getPirates()[$pirateIndex]->setCoinsInHand($coins);
                    $huntModel->getPirates()[$pirateIndex]->setIsHunting(false);

                    if (1 < count($pirateIndexes)) {
                        $huntModel->addLogLine(sprintf(
                            'Pirate %d fights pirates %s and gets away with %d coins.',
                            $huntModel->getPirates()[$pirateIndex]->getId(),
                            implode(', ', array_filter($pirateIndexes, function ($x) {
                                return $x + 1;
                            })),
                            $coins
                        ));
                    }
                }
            }
        }
    }

    /**
     * @param HuntModel $huntModel
     *
     * @return bool
     */
    public function isFinished(HuntModel $huntModel): bool
    {
        foreach ($huntModel->getMap()->getTiles() as $tile) {
            if ($tile->getCoins() > 0) {
                return false;
            }
        }

        foreach ($huntModel->getPirates() as $pirate) {
            if ($pirate->getCoinsInHand() > 0) {
                return false;
            }
        }

        return true;
    }
}
