<?php


class Logger
{
    public static function get()
    {
        return new Logger();
    }

    public function logError($message)
    {
        $logFile = fopen('application.log', 'a');
        fwrite($logFile, 'ERROR: ' . $message);
        fclose($logFile);
    }

    public function logSuccess($message)
    {
        $logFile = fopen('application.log', 'a');
        fwrite($logFile, 'SUCCESS: ' . $message);
    }
}