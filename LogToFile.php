<?php

require_once 'AbstractOutput.php';

class LogToFile extends AbstractOutput
{
    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Write message to file
     *
     * @param $type
     * @param $message
     * @return void
     */
    public function out($type, $message)
    {
        $logFile = fopen($this->getFile(), 'a');

        return $this->output($logFile, $type, $message);
    }

    /**
     * @return string
     */
    private function getFile(): string
    {
        return $this->file;
    }
}
