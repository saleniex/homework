<?php

class Logger
{
    protected $fileLocation = 'application.log';

    protected $consoleOutput = false;

    public function __construct()
    {
        $this->checkArguments();
    }

    public static function get()
    {
        return new Logger();
    }

    public function logError($message)
    {
        $this->addRecord('ERROR', $message);
    }

    public function logSuccess($message)
    {
        $this->addRecord('SUCCESS', $message);
    }

    protected function addRecord(string $level, string $message): void
    {
        $record = $level . ': ' . $message . PHP_EOL;

        if ($this->consoleOutput) {
            $this->printToConsole($record);
        } else {
            $this->writeToFile($record);
        }
    }

    protected function writeToFile(string $message): void
    {
        $record = $message . PHP_EOL;

        $logFile = fopen($this->fileLocation, 'a');
        fwrite($logFile, $record);
        fclose($logFile);
    }

    protected function printToConsole(string $record): void
    {
        echo $record;
    }

    protected function checkArguments(): void
    {
        $arguments = $this->getArguments();

        foreach ($arguments as $argument) {
            switch ($argument) {
                case '--console':
                case '--c':
                    $this->setConsoleOutput(true);
                    break;
                // Place for more arguments and their methods
            }
        }
    }

    protected function getArguments(): array
    {
        $arguments = $_SERVER['argv'];

        // Remove first argument because it's a file name
        array_shift($arguments);

        return $arguments;
    }

    public function setConsoleOutput(bool $status): void
    {
        $this->consoleOutput = $status;
    }
}