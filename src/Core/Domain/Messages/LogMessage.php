<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Messages;

class LogMessage
{
    public string $text;

    public function __construct(string $text) {
        $this->text = $text;
    }
}