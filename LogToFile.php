<?php

require_once 'OutputInterface.php';

class LogToFile implements OutputInterface
{
    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function out($type, $message)
    {
        $logFile = fopen($this->getFile(), 'a');

        fwrite($logFile, strtoupper($type) . ': ' . $message . "\n");
        fclose($logFile);
    }

    private function getFile()
    {
        return $this->file;
    }
}
