<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use Homework\LoggerInterface;
use Homework\FileLogger;

class Logger
{
    public static function get() : LoggerInterface
    {
        return new FileLogger();
    }
}