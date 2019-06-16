<?php

require_once 'AbstractLogger.php';
require_once 'LogToConsole.php';

class Logger extends AbstractLogger
{
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public static function get()
    {
        return new Logger(new LogToConsole());
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function log($type, $message)
    {
        return $this->getOutput()->out($type, $message);
    }
}
