<?php

declare(strict_types=1);

namespace Homework;

use Homework\Format\FormatterInterface;
use Homework\Output\HandlerInterface;

/**
 * Class AbstractLogger
 * @package Homework
 */
abstract class AbstractLogger implements LoggerInterface
{
    /**
     * @var HandlerInterface
     */
    protected $outputHandler;

    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * AbstractLogger constructor.
     * @param HandlerInterface $outputHandler
     * @param FormatterInterface $formatter
     */
    public function __construct(HandlerInterface $outputHandler, FormatterInterface $formatter)
    {
        $this->outputHandler = $outputHandler;
        $this->formatter = $formatter;
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
        $this->outputHandler->write(
            $this->formatter->format($message, $level));
    }
}