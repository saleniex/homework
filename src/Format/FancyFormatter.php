<?php

declare(strict_types=1);

namespace Homework\Format;

/**
 * Class ConcatFormatter
 * @package Homework\Format
 */
class FancyFormatter implements FormatterInterface {
    /**
     * @param string $message
     * @param string $level
     * @return string
     */
    public function format(string $message, string $level): string
    {
        return sprintf("[%s]: %s\n", $level, $message);
    }
}