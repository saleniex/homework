<?php

require_once 'OutputInterface.php';

abstract class AbstractOutput implements OutputInterface
{
    /**
     * Format message
     *
     * @param $type
     * @param $message
     * @return
     */
    public function formatMessage($type, $message)
    {
        return mb_strtoupper($type) . ': ' . $message . "\n";
    }

    /**
     * Output formatted message
     *
     * @param $outputMethod
     * @param $type
     * @param $message
     * @return void
     */
    public function output($outputMethod, $type, $message)
    {
        fwrite($outputMethod, $this->formatMessage($type, $message));
        fclose($outputMethod);
    }
}
