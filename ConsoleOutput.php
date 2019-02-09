<?php

require_once 'AbstractOutput.php';
require_once 'LogLevel.php';

class ConsoleOutput extends AbstractOutput
{
    public function write($message, $level)
    {
        $stream = $this->openStream($level);
        $message = $this->prepareMessage($message, $level);

        $message = $message . "\n";
        fwrite($stream, $message);
        fclose($stream);
    }

    private function openStream($level)
    {
        $stream = $level == LogLevel::ERROR ? 'php://stderr' : 'php://stdout';
        return fopen($stream, 'w');
    }

    private function prepareMessage($message, $level)
    {
        if ($level == LogLevel::ERROR) {
            $message = sprintf("\033[01;31m%s\033[0m", $message);
        }
        return $message;
    }
}
