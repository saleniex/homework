<?php

declare(strict_types=1);

namespace Homework\Output;

/**
 * Class StreamHandler
 * @package Homework\Output
 */
class StreamHandler implements HandlerInterface
{
    /**
     * @var resource
     */
    protected $resource;

    /**
     * StreamHandler constructor.
     * @param resource $resource
     * @return void
     */
    public function __construct($resource)
    {
        if (is_resource($resource)) {
            $this->resource = $resource;
        } else {
            throw new \InvalidArgumentException('A valid resource is required');
        }
    }

    /**
     * @param string $message
     * @return void
     */
    public function write(string $message): void
    {
        fwrite($this->resource, $message);
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        ftruncate($this->resource, 0);
    }

}