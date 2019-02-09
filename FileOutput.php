<?php

require_once 'AbstractOutput.php';

class FileOutput extends AbstractOutput
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function write($message, $level)
    {
        $file = fopen($this->file, 'a');
        $message = strtoupper($level) . ': ' . $message . "\n";
        fwrite($file, $message);
        fclose($file);
    }
}
