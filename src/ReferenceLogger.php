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
     * @var resource
     */
    private $resource;

    /**
     * ReferenceLogger constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName = "application.log")
    {
        $this->resource = fopen($fileName, 'w');
    }

    /**
     * @param string $message
     * @return void
     */
    public function logError(string $message): void
    {
        ftruncate($this->resource, 0);
        $this->log($message, LogLevel::ERROR);
    }

    /**
     * @param string $message
     * @return void
     */
    public function logSuccess(string $message): void
    {
        $this->log($message, LogLevel::SUCCESS);
    }

    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    public function log(string $message, string $level): void
    {
        fwrite($this->resource, $level . ': ' . $message);
    }
}