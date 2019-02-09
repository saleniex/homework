<?php

require_once 'AbstractLogger.php';

class Logger extends AbstractLogger
{
    public static function get()
    {
        return new Logger();
    }

    protected function logMessage($message)
    {
        $logFile = fopen('application.log', 'a');
        fwrite($logFile, $message . "\n");
        fclose($logFile);
    }
}
