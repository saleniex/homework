<?php

require 'Logger.php';

class LoggerTest extends \PHPUnit\Framework\TestCase
{
    protected $logger;

    public function setUp(): void
    {
        $this->logger = Logger::get();
    }

    /** @test */
    public function console_output_is_visible(): void
    {
        $this->logger->setConsoleOutput(true);
        $this->logger->logSuccess('Test log');

        $record = 'SUCCESS: Test log' . PHP_EOL;

        $this->expectOutputString($record);
    }
}