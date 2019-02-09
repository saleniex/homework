<?php

require_once 'AbstractLogger.php';
require_once 'FileOutput.php';

/**
 * Message logger.
 */
class Logger extends AbstractLogger
{
    private $output;

    /**
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Gets Logger instance.
     *
     * @return Logger
     */
    public static function get()
    {
        return new Logger(new FileOutput('application.log'));
    }

    /**
     * Logs message with level.
     *
     * @param $level
     * @param $message
     * @return void
     */
    public function logMessage($level, $message)
    {
        $this->output->write($message, $level);
    }
}
