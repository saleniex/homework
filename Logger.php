<?php

class Logger
{
    protected static $logger;

    protected const LEVELS = [
        1 => 'ERROR',
        2 => 'SUCCESS',
    ];

    protected $fileLocation = 'application.log';

    protected $consoleOutput = false;

    public function __construct()
    {
        $this->checkArguments();
    }

    public static function get(): self
    {
        if (!self::$logger) {
            self::$logger = new Logger();
        }

        return self::$logger;
    }

    public function logError(string $message): void
    {
        $this->addRecord(1, $message);
    }

    public function logSuccess(string $message): void
    {
        $this->addRecord(2, $message);
    }

    protected function addRecord(int $level, string $message): void
    {
        $levelName = $this->getLevelName($level);

        $record = $levelName . ': ' . $message . PHP_EOL;

        if ($this->consoleOutput) {
            $this->printToConsole($record);
        } else {
            $this->writeToFile($record);
        }
    }

    protected function writeToFile(string $message): void
    {
        $logFile = fopen($this->fileLocation, 'a');
        fwrite($logFile, $message);
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

    public function getLevelName(int $level): string
    {
        return self::LEVELS[$level];
    }
}