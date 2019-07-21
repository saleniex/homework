<?php

namespace Homework;

class FileLogger implements LoggerInterface
{
    public function logError($message) : void
    {
        $logFile = fopen('application.log', 'w');
        fwrite($logFile, 'ERROR: ' . $message);
        fclose($logFile);
    }

    public function logSuccess($msg) : void
    {
        $logFile = fopen('application.log', 'a');
        fwrite($logFile, 'SUCCESS: ' . $msg);
    }
}