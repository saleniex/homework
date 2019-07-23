<?php

namespace Homework\Formatter;

interface FormatterInterface
{
    public function format(string $type, string $message) : string;
}