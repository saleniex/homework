<?php

interface LoggerInterface
{
    public function logError($message);

    public function logSuccess($message);
}
