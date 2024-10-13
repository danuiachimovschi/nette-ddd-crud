<?php

declare(strict_types=1);

use Nette\Application\Application;
use YourProjectName\Bootstrap;

require __DIR__ . '/../vendor/autoload.php';

$configurator = Bootstrap::boot();
$container = $configurator->createContainer();
$container->getByType(Application::class)->run();
