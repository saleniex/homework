<?php

declare(strict_types=1);

namespace Homework\Format;

/**
 * Interface FormatterInterface
 * @package Homework\Format
 */
interface FormatterInterface
{
    /**
     * @param string $message
     * @param string $level
     * @return string
     */
    public function format(string $message, string $level): string;
}
