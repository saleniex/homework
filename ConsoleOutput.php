<?php

require_once 'AbstractOutput.php';
require_once 'LogLevel.php';
require_once 'InvalidArgumentException.php';
require_once 'OutputException.php';

/**
 * Output to CLI console.
 */
class ConsoleOutput extends AbstractOutput
{
    /**
     * Output stream map.
     *
     * @var array
     */
    private $streamMap = [
        LogLevel::ERROR => 'php://stderr',
        LogLevel::SUCCESS => 'php://stdout',
    ];

    /**
     * Outputs message.
     *
     * @param $message
     * @param $level
     * @throws OutputException
     * @return void
     */
    public function write($message, $level)
    {
        if (!array_key_exists($level, $this->streamMap)) {
            throw new InvalidArgumentException(sprintf('Invalid console output level: %s.', $level));
        }

        $stream = @fopen($this->streamMap[$level], 'w');
        if ($stream === false) {
            throw new OutputException(sprintf('Unable to open console stream: %s.', $this->streamMap[$level]));
        }

        $message = $this->decorateMessage($message, $level);
        $message .= "\n";

        if (@fwrite($stream, $message) === false) {
            throw new OutputException(sprintf('Unable to write to console stream: %s.', $this->streamMap[$level]));
        }
        @fclose($stream);
    }

    /**
     * Formats message color if error.
     *
     * @param $message
     * @param $level
     * @return string
     */
    private function decorateMessage($message, $level)
    {
        if ($level == LogLevel::ERROR) {
            $message = sprintf("\033[01;31m%s\033[0m", $message);
        }
        return $message;
    }
}
