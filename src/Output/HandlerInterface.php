<?php

declare(strict_types=1);

namespace Homework\Output;

/**
 * Interface HandlerInterface
 * @package Homework\Output
 */
interface HandlerInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function write(string $message): void;

    /**
     * @return void
     */
    public function clear(): void;
}