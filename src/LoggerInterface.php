<?php

declare(strict_types=1);

namespace Homework;

interface LoggerInterface
{
    public function logError(string $message) : void;
    public function logSuccess(string $message) : void;
}