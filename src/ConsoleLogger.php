<?php

namespace Homework;

use Homework\AbstractLogger;

class ConsoleLogger extends AbstractLogger
{
    /**
     * Log message to console
     */
    protected function logMessage(string $logType, string $message) : void
    {
        printf("%s: %s\n", $logType, $message);
    }
}