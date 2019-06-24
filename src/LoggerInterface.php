<?php

declare(strict_types=1);

namespace Homework;

/**
 * Interface LoggerInterface
 * @package Homework
 */
interface LoggerInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function logError(string $message): void;

    /**
     * @param string $message
     * @return void
     */
    public function logSuccess(string $message): void;


    /**
     * @param string $message
     * @param string $level
     * @return void
     */
    public function log(string $message, string $level): void;
}