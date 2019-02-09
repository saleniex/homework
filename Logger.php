<?php

require_once 'AbstractLogger.php';
require_once 'FileOutput.php';

class Logger extends AbstractLogger
{
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public static function get()
    {
        return new Logger(new FileOutput('application.log'));
    }

    public function logMessage($level, $message)
    {
        $this->output->write($message, $level);
    }
}
