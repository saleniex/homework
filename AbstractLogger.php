<?php

require_once 'LoggerInterface.php';

abstract class AbstractLogger implements LoggerInterface
{
    public function logError($message)
    {
        return $this->log(self::ERROR, $message);
    }

    public function logSuccess($message)
    {
        return $this->log(self::SUCCESS, $message);
    }
}
