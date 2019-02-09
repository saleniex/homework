<?php

require_once 'LoggerInterface.php';

abstract class AbstractLogger implements LoggerInterface
{
    public function logError($message)
    {
        $this->logMessage(self::ERROR, $message);
    }

    public function logSuccess($message)
    {
        $this->logMessage(self::SUCCESS, $message);
    }
}
