<?php


class Logger
{
    public static function get()
    {
        return new Logger();
    }

    public function logError($message)
    {
        $this->logMessage('ERROR: ' . $message);
    }

    public function logSuccess($message)
    {
        $this->logMessage('SUCCESS: ' . $message);
    }

    protected function logMessage($message)
    {
        $logFile = fopen('application.log', 'a');
        fwrite($logFile, $message . "\n");
        fclose($logFile);
    }
}