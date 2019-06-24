<?php

declare(strict_types=1);

use Homework\LoggerInterface;
use Homework\ReferenceLogger;

require __DIR__ . '/vendor/autoload.php';

/**
 * Class Logger
 */
class Logger
{
    /**
     * @return LoggerInterface
     */
    public static function get(): LoggerInterface
    {
        return new ReferenceLogger();
    }

}