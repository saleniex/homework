<?php

/**
 * Describes Logger instance.
 */
interface LoggerInterface
{
    /**
     * Logs error message.
     *
     * @param $message
     * @return void
     */
    public function logError($message);

    /**
     * Logs success message.
     *
     * @param $message
     * @return void
     */
    public function logSuccess($message);

    /**
     * Logs message with level.
     *
     * @param $level
     * @param $message
     * @return void
     */
    public function logMessage($level, $message);
}
