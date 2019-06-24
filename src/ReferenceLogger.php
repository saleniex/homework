<?php

declare(strict_types=1);

namespace Homework;

use Homework\Format\ConcatFormatter;
use Homework\Format\FormatterInterface;
use Homework\Output\HandlerInterface;
use Homework\Output\StreamHandler;

/**
 * Class ReferenceLogger
 * @package Homework
 */
class ReferenceLogger implements LoggerInterface
{
    /**
     * @var HandlerInterface
     */
    private $handler;

    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * ReferenceLogger constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName = "application.log")
    {
        $this->handler = new StreamHandler(fopen($fileName, 'a+'));
        $this->formatter = new ConcatFormatter();
    }

    /**
     * @param string $message
     * @return void
     */
    public function logError(string $message): void
    {
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
        // Error clears, everything else appends
        if ($level === LogLevel::ERROR) {
            $this->handler->clear();
        }
        $this->handler->write(
            $this->formatter->format($message, $level));
    }
}