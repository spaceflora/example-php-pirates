<?php

namespace Pirates\Controller;

use Pirates\Application\Service\HuntApplicationService;

/**
 * Class PiratesController
 */
class PiratesController extends Controller
{
    /** @var HuntApplicationService */
    private HuntApplicationService $huntApplicationService;

    /**
     * HuntApplicationService constructor.
     */
    public function __construct()
    {
        $this->huntApplicationService = new HuntApplicationService();

        parent::__construct();
    }

    /**
     * @param int $piratesCount
     */
    public function start(int $piratesCount): void
    {
        try {
            $huntModel = $this->huntApplicationService->setup($piratesCount);
            $this->huntApplicationService->run($huntModel);
            $this->renderLines($huntModel->getLogLines());
        } catch (\Exception $e) {
            $this->renderLine($e->getMessage());
        }
    }
}