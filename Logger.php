<?php


class Logger
{
    private const ERROR = "ERROR";
    private const SUCCESS = "SUCCESS";

    private $logFileLocation = __DIR__. '/' . 'application_logs.log';

    /**
     * @param string|null $logFileLocation
     */
    public static function get($logFileLocation = null)
    {
        return new Logger($logFileLocation);
    }

    /**
     * If no file location provided logger writes to 
     * __DIR__ . 'application_logs.log' 
     * 
     * @param string|null $logFileLocation
     */
    public function __construct($logFileLocation)
    {
        if (isset($logFileLocation)) {
            $this->logFileLocation = logFileLocation;
        }
    }

    /**
     * @param string $message
     */
    public function logError($message)
    {
        $this->writeToFile($message, self::ERROR);
    }

    /**
     * @param string $message
     */
    public function logSuccess($message)
    {
        $this->writeToFile($message, self::SUCCESS);
    }

    /**
     * @param string $message
     * @param string $status
     */
    private function writeToFile($message, $status)
    {
        $logFile = fopen($this->logFileLocation, 'a');
        fwrite($logFile, $status. ': ' . $message . PHP_EOL);
        fclose($logFile);
    }
}