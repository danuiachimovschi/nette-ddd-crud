<?php

declare(strict_types=1);

namespace YourProjectName;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
    public static function boot(): Configurator
    {
        $configurator = new Configurator;
        $rootDir = dirname(__DIR__);

        $configurator->setDebugMode(true);
        $configurator->enableTracy($rootDir . '/log');

        $configurator->setTempDirectory($rootDir . '/temp');

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();

        $configurator->addConfig($rootDir . '/config/common.neon');
        $configurator->addConfig($rootDir . '/config/config.neon');
        $configurator->addConfig($rootDir . '/config/services.neon');

        return $configurator;
    }
}