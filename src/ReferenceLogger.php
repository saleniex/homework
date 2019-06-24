<?php

declare(strict_types=1);

namespace Homework;

/**
 * Class ReferenceLogger
 * @package Homework
 */
class ReferenceLogger implements LoggerInterface
{
    /**
     * @var string
     */
    private $fileName;

    public function __construct(string $fileName = "application.log")
    {
        $this->fileName = $fileName;
    }

    /**
     * @param string $message
     * @return void
     */
    public function logError(string $message): void
    {
        $logFile = fopen($this->fileName, 'w');
        fwrite($logFile, 'ERROR: ' . $message);
        fclose($logFile);
    }

    /**
     * @param string $message
     * @return void
     */
    public function logSuccess(string $message): void
    {
        $logFile = fopen($this->fileName, 'a');
        fwrite($logFile, 'SUCCESS: ' . $message);
    }


}