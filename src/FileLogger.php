<?php

namespace Homework;

use Homework\Exceptions\LogTypeException;

class FileLogger extends AbstractLogger
{
    const LOG_MODE_APPEND_TEXT = 'a';
    const LOG_MODE_PREPEND_TEXT = 'w';

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
     * Log string message to file
     * @param string $logType
     * @param string $message
     */
    protected function logMessage(string $logType, string $message) : void
    {
        $mode = $this->getFileOpenMode($logType);

        $logFile = fopen($this->logFileName, $mode);
        fwrite(
            $logFile,
            sprintf("%s: %s", $logType, $message)
        );
        fclose($logFile);
    }

    /**
     * Get file open mode depending on log type
     * @param string $logType
     *
     * @return string
     */
    protected function getFileOpenMode(string $logType) : string
    {
        switch ($logType) {
            case self::LOG_TYPE_ERROR:
                return self::LOG_MODE_PREPEND_TEXT;
                break;
            case self::LOG_TYPE_SUCCESS:
                return self::LOG_MODE_APPEND_TEXT;
                break;
            default:
                throw new LogTypeException("Invalid log type!");
                break;
        }
    }
}