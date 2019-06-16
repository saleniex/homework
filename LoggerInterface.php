<?php

interface LoggerInterface
{
    const ERROR = 'error';
    const SUCCESS = 'success';

    /**
     * Log error message
     *
     * @param  string $message
     */
    public function logError(string $message);

    /**
     * Log success message
     *
     * @param  string $message
     */
    public function logSuccess(string $message);

    /**
     * Log message
     *
     * @param  string $type
     * @param  string $message
     */
    public function log(string $type, string $message);
}
