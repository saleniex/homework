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
        $stream = $this->openStream($level);
        $message = $this->prepareMessage($message, $level);

        $message = $message . "\n";
        fwrite($stream, $message);
        fclose($stream);
    }

    /**
     * Opens level specific output stream.
     *
     * @param $level
     * @return resource
     */
    private function openStream($level)
    {
        $stream = $level == LogLevel::ERROR ? 'php://stderr' : 'php://stdout';
        return fopen($stream, 'w');
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
