<?php

/**
 * Describes Output instance.
 */
interface OutputInterface
{
    /**
     * Outputs message.
     *
     * @param $message
     * @param $level
     * @return void
     */
    public function write($message, $level);
}
