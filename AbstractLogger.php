<?php

require_once 'LoggerInterface.php';
require_once 'LogLevel.php';

abstract class AbstractLogger implements LoggerInterface
{
    public function logError($message)
    {
        $this->logMessage(LogLevel::ERROR, $message);
    }

    public function logSuccess($message)
    {
        $this->logMessage(LogLevel::SUCCESS, $message);
    }
}
