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
        print($this->getFormatedMessage($logType, $message) . "\n");
    }
}