<?php

require_once 'AbstractLogger.php';
require_once 'FileOutput.php';

/**
 * Message logger.
 */
class Logger extends AbstractLogger
{
    /**
     * Output instance.
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * List of valid log levels.
     *
     * @var array
     */
    private $levels = [
        LogLevel::ERROR,
        LogLevel::SUCCESS,
    ];

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
        return new self(new FileOutput('application.log'));
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
        if (!in_array($level, $this->levels)) {
            throw new InvalidArgumentException(sprintf('Invalid log level: %s.', $level));
        }

        $message = $this->formatMessage($message, $level);
        $this->output->write($message, $level);
    }

    /**
     * Adds level prefix to message.
     *
     * @param $message
     * @param $level
     * @return string
     */
    private function formatMessage($message, $level)
    {
        return strtoupper($level) . ': ' . $message;
    }
}
