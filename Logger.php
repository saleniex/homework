<?php

class Logger
{
    protected $fileLocation = 'application.log';

    public static function get()
    {
        return new Logger();
    }

    public function logError($message)
    {
        $this->writeToFile('ERROR: ' . $message);
    }

    public function logSuccess($message)
    {
        $this->writeToFile('SUCCESS: ' . $message);
    }

    protected function writeToFile(string $message): void
    {
        $record = $message . PHP_EOL;

        $logFile = fopen($this->fileLocation, 'a');
        fwrite($logFile, $record);
        fclose($logFile);
    }
}