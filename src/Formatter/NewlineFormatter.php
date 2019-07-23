<?php

namespace Homework\Formatter;

class NewlineFormatter implements FormatterInterface
{
    /**
     * @param string $type
     * @param string $message
     *
     * @return string
     */
    public function format(string $type, string $message) : string
    {
        return sprintf("%s: %s\n", $type, $message);
    }
}