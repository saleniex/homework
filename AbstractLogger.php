<?php

require_once 'LoggerInterface.php';

abstract class AbstractLogger implements LoggerInterface
{
    /**
     * Log error message
     *
     * @param string $message
     * @return void
     */
    public function logError(string $message)
    {
        return $this->log(self::ERROR, $message);
    }

    /**
     * Log success message
     *
     * @param string $message
     * @return void
     */
    public function logSuccess(string $message)
    {
        return $this->log(self::SUCCESS, $message);
    }
}
