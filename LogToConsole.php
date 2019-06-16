<?php

require_once 'AbstractOutput.php';

class LogToConsole extends AbstractOutput
{
    const PHP_OUT = 'php://stdout';

    /**
     * Output console message
     *
     * @param $type
     * @param $message
     * @return void
     */
    public function out($type, $message)
    {
        $console = $this->getConsoleOutputMethod();

        return $this->output($console, $type, $message);
    }

    /**
     * Open console stream
     */
    private function getConsoleOutputMethod()
    {
        return fopen(self::PHP_OUT, 'w');
    }
}
