<?php

require(__DIR__ . '/../vendor/autoload.php');

$piratesController = new Pirates\Controller\PiratesController();
$piratesCount = true === isset($argv[1]) ? $argv[1] : 3;

try {
    $piratesController->start($piratesCount);
} catch (Exception $e) {
    print $e->getMessage();
}
