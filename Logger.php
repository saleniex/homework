<?php

require "vendor/autoload.php";

use Classes\ConsoleLogger;
use Interfaces\LoggerInterface;
use Classes\FileLogger;

class Logger
{
    public static function get(): LoggerInterface
    {
        // To switch between console log or file log, return must be set either to new FileLogger() or new ConsoleLogger()
        return new ConsoleLogger();
    }

}