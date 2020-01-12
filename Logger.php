<?php

class Logger
{
    /**
     * Logger object.
     *
     * @var self
     */
    protected static $logger;

    /**
     * Const of log levels.
     *
     * @var string[]
     */
    protected const LEVELS = [
        1 => 'ERROR',
        2 => 'SUCCESS',
    ];

    /**
     * Locate log file path.
     *
     * @var string
     */
    protected $fileLocation = 'application.log';

    /**
     * Indicates whether to print log record to console.
     *
     * @var bool
     */
    protected $consoleOutput = false;

    /**
     * Create a new logger instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->checkArguments();
    }

    /**
     * Check if Logger is initialized.
     *
     * @return self
     */
    public static function get(): self
    {
        if (!self::$logger) {
            self::$logger = new Logger();
        }

        return self::$logger;
    }

    /**
     * Log error message.
     *
     * @param  string  $message
     * @return self
     */
    public function logError(string $message): self
    {
        $this->addRecord(1, $message);

        return $this;
    }

    /**
     * Log success message.
     *
     * @param  string  $message
     * @return self
     */
    public function logSuccess(string $message): self
    {
        $this->addRecord(2, $message);

        return $this;
    }

    /**
     * Creates log record.
     *
     * @param  string  $level
     * @param  string  $message
     * @return void
     */
    protected function addRecord(int $level, string $message): void
    {
        $levelName = $this->getLevelName($level);
        $timestamp = $this->getTimestamp();

        $record = '[' . $timestamp . '] ' . $levelName . ': ' . $message . PHP_EOL;

        if ($this->consoleOutput) {
            $this->printToConsole($record);
        } else {
            $this->writeToFile($record);
        }
    }

    /**
     * Write log record to a file.
     *
     * @param  string  $record
     * @return void
     */
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

    /**
     * Print log record to console.
     *
     * @param  string  $record
     * @return self
     */
    protected function printToConsole(string $record): self
    {
        echo $record;

        return $this;
    }

    /**
     * Create timestamp.
     *
     * @return string
     */
    protected function getTimestamp(): string
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Read passed arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        $arguments = $_SERVER['argv'];

        // Remove first argument because it's a file name
        array_shift($arguments);

        return $arguments;
    }

    /**
     * Iterate through passed arguments and execute methods.
     *
     * @return void
     */
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

    /**
     * Set console output.
     *
     * @param  bool  $status
     * @return self
     */
    public function setConsoleOutput(bool $status): self
    {
        $this->consoleOutput = $status;

        return $this;
    }

    /**
     * Get log file location.
     *
     * @return string
     */
    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    /**
     * Set log file location.
     *
     * @param  string  $fileLocation
     * @return self
     */
    public function setFileLocation(string $fileLocation): self
    {
        $this->fileLocation = $fileLocation;

        return $this;
    }

    /**
     * Clear log file.
     *
     * @return self
     */
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

    /**
     * Get logging level name.
     *
     * @throws InvalidArgumentException
     */
    public function getLevelName(int $level): string
    {
        if (!isset(self::LEVELS[$level])) {
            throw new InvalidArgumentException('Level "' . $level . '" is not defined');
        }

        return self::LEVELS[$level];
    }
}