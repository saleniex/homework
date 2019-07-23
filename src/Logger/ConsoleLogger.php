<?php

namespace Homework\Logger;

use Homework\Formatter\FormatterInterface;

class ConsoleLogger extends AbstractLogger
{
    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @param FormatterInterface $formatter
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Log message to console
     */
    protected function logMessage(string $logType, string $message) : void
    {
        print($this->formatter->format($logType, $message));
    }
}