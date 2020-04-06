<?php

namespace Pirates\Application\Exception;

/**
 * Class PiratesCountException
 */
class PiratesCountException extends \Exception
{
    /**
     * PiratesCountException constructor.
     *
     * @param int $piratesCount
     */
    public function __construct(int $piratesCount)
    {
        parent::__construct(sprintf('The minimal is 2 pirates, %d given.', $piratesCount));
    }
}
