<?php

namespace Pirates\Application\Service;

use Pirates\Application\Exception\PiratesCountException;
use Pirates\Domain\Service\HuntDomainService;
use Pirates\Domain\Service\MapDomainService;
use Pirates\Domain\Service\PirateDomainService;
use Pirates\Model\HuntModel;

/**
 * Class HuntApplicationService
 */
class HuntApplicationService
{
    /** @var HuntDomainService */
    private HuntDomainService $huntDomainService;
    /** @var MapDomainService */
    private MapDomainService $mapDomainService;
    /** @var PirateDomainService */
    private PirateDomainService $pirateDomainService;

    /**
     * HuntApplicationService constructor.
     */
    public function __construct()
    {
        $this->huntDomainService = new HuntDomainService();
        $this->mapDomainService = new MapDomainService();
        $this->pirateDomainService = new PirateDomainService();
    }

    /**
     * @param int $piratesCount
     *
     * @return HuntModel
     * @throws PiratesCountException
     */
    public function setup(int $piratesCount): HuntModel
    {
        if ($piratesCount < 2) {
            throw new PiratesCountException($piratesCount);
        }

        $map = $this->mapDomainService->generate($piratesCount);
        $pirates = $this->pirateDomainService->generate($piratesCount);

        return new HuntModel($map, $pirates);
    }

    /**
     * @param HuntModel $huntModel
     */
    public function run(HuntModel $huntModel): void
    {
        do {
            foreach ($huntModel->getPirates() as $pirate) {
                $this->pirateDomainService->move($pirate, $huntModel->getMap());

                $huntModel->addLogLine(sprintf(
                    'Pirate %d %s from %d,%d to %d,%d.',
                    $pirate->getId(),
                    $pirate->isHunting() ? 'hunting' : 'returning',
                    $pirate->getLastPos()->getX(),
                    $pirate->getLastPos()->getY(),
                    $pirate->getCurrentPos()->getX(),
                    $pirate->getCurrentPos()->getY()
                ));
            }

            $this->huntDomainService->distributeCoins($huntModel);
        } while (false === $this->huntDomainService->isFinished($huntModel));

        foreach ($huntModel->getPirates() as $pirate) {
            $huntModel->addLogLine(sprintf(
                'Pirate %d leaves with %d coins.',
                $pirate->getId(),
                $pirate->getCoinsInShip()
            ));
        }
    }
}
