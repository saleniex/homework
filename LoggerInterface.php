<?php

interface LoggerInterface
{
    public function logError($message);

    public function logSuccess($message);

    public function logMessage($level, $message);
}
