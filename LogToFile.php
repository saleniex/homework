<?php

require_once 'AbstractOutput.php';

class LogToFile extends AbstractOutput
{
    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function out($type, $message)
    {
        $logFile = fopen($this->getFile(), 'a');

        return $this->output($logFile, $type, $message);
    }

    private function getFile()
    {
        return $this->file;
    }
}
