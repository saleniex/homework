<?php

namespace Homework\Formatter;

class Formatter implements FormatterInterface
{
    /**
     * @param string $type
     * @param string $message
     *
     * @return string
     */
    public function format(string $type, string $message) : string
    {
        return sprintf("%s: %s", $type, $message);
    }
}