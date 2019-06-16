<?php

require_once 'OutputInterface.php';

abstract class AbstractOutput implements OutputInterface
{
    public function formatMessage($type, $message)
    {
        return mb_strtoupper($type) . ': ' . $message . "\n";
    }

    public function output($outputMethod, $type, $message)
    {
        fwrite($outputMethod, $this->formatMessage($type, $message));
        fclose($outputMethod);
    }
}
