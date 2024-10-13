<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Handlers;

use RuntimeException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use YourProjectName\Core\Domain\Messages\LogMessage;

#[AsMessageHandler]
class LogHandler
{
    public function __invoke(LogMessage $message): void
    {
        $stdout = fopen("php://stdout", "w");
        if (!$stdout) {
            throw new RuntimeException("Unable to open stdout");
        }

        fwrite($stdout, "its working");
    }
}