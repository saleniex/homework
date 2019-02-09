<?php

interface LoggerInterface
{
    const ERROR = 'error';
    const SUCCESS = 'success';

    public function logError($message);

    public function logSuccess($message);

    public function logMessage($level, $message);
}
