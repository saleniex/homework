<?php

require_once "LoggerInterface.php";
require_once "ConsoleLogger.php";
require_once "FileLogger.php";

class Logger
{
    public static function get(): LoggerInterface
    {
        // To switch between logging in console or in file, return must be changed either to FileLogger or ConsoleLogger
        return new FileLogger();
    }

}