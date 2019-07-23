<?php

namespace Homework;

use Homework\Exceptions\LogTypeException;
use Homework\Formatter\FormatterInterface;

class FileLogger extends AbstractLogger
{
    const LOG_MODE_APPEND_TEXT = 'a';
    const LOG_MODE_PREPEND_TEXT = 'w';

    /**
     * @var string
     */
    private $logFileName;
    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @param FormatterInterface $formatter
     * @param string $logFileName
     */
    public function __construct(FormatterInterface $formatter, string $logFileName = 'application.log')
    {
        $this->logFileName = $logFileName;
        $this->formatter = $formatter;
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
            $this->formatter->format($logType, $message)
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