<?php

require_once 'AbstractLogger.php';

class Logger extends AbstractLogger
{
    public static function get()
    {
        return new Logger();
    }

    public function log($type, $message)
    {
        $logFile = fopen('application.log', 'a');

        fwrite($logFile, strtoupper($type) . ': ' . $message . "\n");
        fclose($logFile);
    }
}
