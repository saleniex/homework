<?php

namespace Homework;

class FileLogger implements LoggerInterface
{
    const LOG_PREFIX_SUCCESS = 'SUCCESS';
    const LOG_PREFIX_ERROR = 'ERROR';
    const LOG_MODE_SUCCESS = 'a';
    const LOG_MODE_ERROR = 'w';

    /**
     * @param string
     */
    private $logFileName;

    /**
     * @param string $logFileName
     */
    public function __construct(string $logFileName = 'application.log')
    {
        $this->logFileName = $logFileName;
    }

    /**
     * Log error message to file
     * @param string $message
     */
    public function logError(string $message) : void
    {
        $this->logMessage(
            $message,
            self::LOG_MODE_ERROR,
            self::LOG_PREFIX_ERROR
        );
    }

    /**
     * Log success message to file
     * @param string $message
     */
    public function logSuccess(string $message) : void
    {
        $this->logMessage(
            $message,
            self::LOG_MODE_SUCCESS,
            self::LOG_PREFIX_SUCCESS
        );
    }

    /**
     * Log string message to file in mode and with prefix passed to it
     * @param string $message
     * @param string $mode
     * @param string $prefix
     */
    protected function logMessage(string $message, string $mode, string $prefix) : void
    {
        $logFile = fopen($this->logFileName, $mode);
        fwrite(
            $logFile,
            sprintf("%s: %s", $prefix, $message)
        );
        fclose($logFile);
    }
}