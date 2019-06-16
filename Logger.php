<?php

require_once 'AbstractLogger.php';
require_once 'LogToConsole.php';

class Logger extends AbstractLogger
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Get logger
     * @return Logger
     */
    public static function get()
    {
        return new Logger(new LogToConsole());
    }

    /**
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Log message
     * 
     * @param  string $type
     * @param  string $message
     * @return void
     */
    public function log(string $type, string $message)
    {
        return $this->getOutput()->out($type, $message);
    }
}
