<?php

require_once 'OutputInterface.php';

class LogToConsole implements OutputInterface
{
    const PHP_OUT = 'php://stdout';

    public function out($type, $message)
    {
        $console = $this->getConsoleOutputMethod();

        fwrite($console, strtoupper($type) . ': ' . $message . "\n");
        fclose($console);
    }

    private function getConsoleOutputMethod()
    {
        return fopen(self::PHP_OUT, 'w');
    }
}
