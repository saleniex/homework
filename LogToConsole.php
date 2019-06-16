<?php

require_once 'AbstractOutput.php';

class LogToConsole extends AbstractOutput
{
    const PHP_OUT = 'php://stdout';

    public function out($type, $message)
    {
        $console = $this->getConsoleOutputMethod();

        return $this->output($console, $type, $message);
    }

    private function getConsoleOutputMethod()
    {
        return fopen(self::PHP_OUT, 'w');
    }
}
