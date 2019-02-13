<?php

require_once 'AbstractOutput.php';
require_once 'LogLevel.php';

/**
 * Output to CLI console.
 */
class ConsoleOutput extends AbstractOutput
{
    /**
     * Outputs message.
     *
     * @param $message
     * @param $level
     * @return void
     */
    public function write($message, $level)
    {
        $message = $this->prepareMessage($message, $level);

        $message = $message . "\n";
        $stream = fopen($this->getStream($level), 'w');
        fwrite($stream, $message);
        fclose($stream);
    }

    /**
     * Returns level specific output stream.
     *
     * @param $level
     * @return string
     */
    private function getStream($level)
    {
        return $level == LogLevel::ERROR ? 'php://stderr' : 'php://stdout';
    }

    /**
     * Formats message color if error.
     *
     * @param $message
     * @param $level
     * @return string
     */
    private function prepareMessage($message, $level)
    {
        if ($level == LogLevel::ERROR) {
            $message = sprintf("\033[01;31m%s\033[0m", $message);
        }
        return $message;
    }
}
