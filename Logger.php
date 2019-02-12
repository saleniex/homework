<?php


class Logger
{
    private const ERROR = "ERROR";
    private const SUCCESS = "SUCCESS";

    private $logFileLocation = __DIR__. '/' . 'application_logs.log';
    private $logToConsole;

    /**
     * @param string|null $logFileLocation
     */
    public static function get($logFileLocation = null, $logToConsole = false)
    {
        return new Logger($logFileLocation, $logToConsole);
    }

    /**
     * If no file location provided logger writes to 
     * __DIR__ . 'application_logs.log' 
     * 
     * @param string|null $logFileLocation
     * @param bool $logToConsole
     */
    public function __construct($logFileLocation, $logToConsole)
    {
        if (isset($logFileLocation)) {
            $this->logFileLocation = logFileLocation;
        }
        $this->logToConsole = $logToConsole;
    }

    /**
     * @param string $message
     */
    public function logError($message)
    {
        $this->writeALog($message, self::ERROR);
    }

    /**
     * @param string $message
     */
    public function logSuccess($message)
    {
        $this->writeALog($message, self::SUCCESS);
    }

    /**
     * @param bool $logToConsole
     */
    public function setOutputToConsole($logToConsole)
    {
        $this->logToConsole = $logToConsole;
    }

    /**
     * @param string $message
     * @param string $status
     */
    private function writeALog($message, $status)
    {
        $fullMessage = $status. ': ' . $message . PHP_EOL;

        if (true == $this->logToConsole) {
            echo $fullMessage;
        } else {
            $logFile = fopen($this->logFileLocation, 'a');
            fwrite($logFile, $fullMessage);
            fclose($logFile);
        }
    }
}