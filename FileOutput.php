<?php

require_once 'AbstractOutput.php';

/**
 * Output to file.
 */
class FileOutput extends AbstractOutput
{
    /**
     * Output file path.
     *
     * @var string
     */
    private $file;

    /**
     * @param string $file File to write messages
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Outputs message.
     *
     * @param $message
     * @param $level
     * @return void
     */
    public function write($message, $level)
    {
        $file = fopen($this->file, 'a');
        $message .= "\n";
        fwrite($file, $message);
        fclose($file);
    }
}
