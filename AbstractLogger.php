<?php

require_once 'LoggerInterface.php';
require_once 'LogLevel.php';

/**
 * Logger implementation for other Loggers to inherit.
 */
abstract class AbstractLogger implements LoggerInterface
{
    /**
     * Logs error message.
     *
     * @param $message
     * @return void
     */
    public function logError($message)
    {
        $this->logMessage(LogLevel::ERROR, $message);
    }

    /**
     * Logs success message.
     *
     * @param $message
     * @return void
     */
    public function logSuccess($message)
    {
        $this->logMessage(LogLevel::SUCCESS, $message);
    }
}
