<?php

require_once 'LoggerInterface.php';

abstract class AbstractLogger implements LoggerInterface
{
    public function logError($message)
    {
        $this->logMessage('ERROR: ' . $message);
    }

    public function logSuccess($message)
    {
        $this->logMessage('SUCCESS: ' . $message);
    }

    abstract protected function logMessage($message);
}
