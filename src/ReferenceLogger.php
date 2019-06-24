<?php

declare(strict_types=1);

namespace Homework;

use Homework\Format\ConcatFormatter;
use Homework\Output\StreamHandler;

/**
 * Appends at the end of the file and clears on ERROR
 * Class ReferenceLogger
 * @package Homework
 */
class ReferenceLogger extends BaseLogger
{
    /**
     * ReferenceLogger constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName = "application.log")
    {
        parent::__construct(new StreamHandler(fopen($fileName, 'a+')), new ConcatFormatter());
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
            $this->outputHandler->clear();
        }

        parent::log($message, $level);
    }
}