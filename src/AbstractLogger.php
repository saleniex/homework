<?php

namespace Homework;

abstract class AbstractLogger implements LoggerInterface
{
    const LOG_TYPE_SUCCESS = 'SUCCESS';
    const LOG_TYPE_ERROR = 'ERROR';

    /**
     * Log error message
     * @param string $message
     */
    public function logError(string $message) : void
    {
        $this->logMessage(
            self::LOG_TYPE_ERROR,
            $message
        );
    }

    /**
     * Log success message
     * @param string $message
     */
    public function logSuccess(string $message) : void
    {
        $this->logMessage(
            self::LOG_TYPE_SUCCESS,
            $message
        );
    }

    /**
     * @param string $logType
     * @param string $message
     *
     * @return string
     */
    protected function getFormatedMessage($logType, $message) : string
    {
        return sprintf("%s: %s", $logType, $message);
    }

    /**
     * Log message as as log type
     * @param string $logType
     * @param string $message
     */
    abstract protected function logMessage(string $logType, string $message) : void;
}