<?php

declare(strict_types=1);

namespace Homework\Output;

/**
 * Class TestHandler
 * @package Homework\Output
 */
class TestHandler implements HandlerInterface
{
    /**
     * @var array
     */
    private $messages;

    /**
     * TestHandler constructor.
     */
    public function __construct()
    {
        $this->messages = [];
    }

    /**
     * @param string $message
     * @return void
     */
    public function write(string $message): void
    {
        $this->messages[] = $message;
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->messages = [];
    }

    /**
     * @return array
     */
    public function getMessages(): array {
        return $this->messages;
    }

}