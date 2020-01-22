<?php

class FileLogger implements LoggerInterface
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
        $logFile = fopen('application.log', 'a');
        fwrite($logFile, $event . $message . PHP_EOL);
        fclose($logFile);
    }
}