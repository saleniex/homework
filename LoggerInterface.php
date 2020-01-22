<?php

interface LoggerInterface
{
    public function logSuccess(string $message): void;

    public function logError(string $message): void;

    public function log(string $event, string $message): void;
}
