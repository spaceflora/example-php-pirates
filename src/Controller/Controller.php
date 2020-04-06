<?php

namespace Pirates\Controller;

/**
 * Class Controller
 */
class Controller
{
    protected function __construct()
    {
        set_time_limit(-1);
    }

    protected function renderLines(array $lines): void
    {
        foreach ($lines as $line) {
            $this->renderLine($line);
        }
    }

    protected function renderLine(string $line): void
    {
        printf("%s\n", $line);
    }
}
