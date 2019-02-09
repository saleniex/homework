<?php

require_once 'AbstractLogger.php';

class Logger extends AbstractLogger
{
    public static function get()
    {
        return new Logger();
    }

    public function logMessage($level, $message)
    {
        $logFile = fopen('application.log', 'a');
        $message = strtoupper($level) . ': ' . $message . "\n";
        fwrite($logFile, $message);
        fclose($logFile);
    }
}
