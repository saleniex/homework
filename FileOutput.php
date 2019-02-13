<?php

require_once 'AbstractOutput.php';
require_once 'OutputException.php';

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
     * @throws OutputException
     * @return void
     */
    public function write($message, $level)
    {
        $file = @fopen($this->file, 'a');
        if ($file === false) {
            throw new OutputException(sprintf('Unable to open file: %s.', $this->file));
        }

        $message .= "\n";

        if (@fwrite($file, $message) === false) {
            throw new OutputException(sprintf('Unable to write to file: %s.', $this->file));
        }
        @fclose($file);
    }
}
