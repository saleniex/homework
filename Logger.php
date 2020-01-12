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

    public function logError(string $message): self
    {
        $this->addRecord(1, $message);

        return $this;
    }

    public function logSuccess(string $message): self
    {
        $this->addRecord(2, $message);

        return $this;
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

    protected function writeToFile(string $record): void
    {
        try {
            $logFile = fopen($this->getFileLocation(), 'a');
            fwrite($logFile, $record);
            fclose($logFile);
        } catch (Exception $ex) {
            // send error to Bugsnag or smth
        }
    }

    protected function printToConsole(string $record): self
    {
        echo $record;

        return $this;
    }

    protected function getTimestamp(): string
    {
        return date('Y-m-d H:i:s');
    }

    protected function getArguments(): array
    {
        $arguments = $_SERVER['argv'];

        // Remove first argument because it's a file name
        array_shift($arguments);

        return $arguments;
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

    public function setConsoleOutput(bool $status): self
    {
        $this->consoleOutput = $status;

        return $this;
    }

    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    public function setFileLocation(string $fileLocation): self
    {
        $this->fileLocation = $fileLocation;

        return $this;
    }

    public function clearLog(): self
    {
        try {
            $handler = fopen($this->fileLocation, 'w');
            fclose($handler);
        } catch (Exception $ex) {
            // send error to Bugsnag or smth
        }

        return $this;
    }

    public function getLevelName(int $level): string
    {
        if (!isset(self::LEVELS[$level])) {
            throw new InvalidArgumentException('Level "' . $level . '" is not defined');
        }

        return self::LEVELS[$level];
    }
}