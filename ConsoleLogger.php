<?php

require 'vendor/autoload.php';

class ConsoleLogger implements LoggerInterface
{
    public function logError(string $message): void
    {
        $this->log("ERROR: ", $message);
    }

    public function logSuccess(string $message): void
    {
        $this->log("SUCCESS: ", $message);
    }

    public function log(string $event, string $message): void
    {
        // "j" is a standard "log" function built in "kint-js" composer package (see composer.json).
        j($event . $message . PHP_EOL);
    }
}