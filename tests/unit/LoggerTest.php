<?php

require 'Logger.php';

class LoggerTest extends \PHPUnit\Framework\TestCase
{
    protected $logger;

    public function setUp(): void
    {
        $this->logger = Logger::get()
            ->setFileLocation('test.log')
            ->clearLog();
    }

    /** @test */
    public function log_file_location_can_be_changed(): void
    {
        $this->logger->setFileLocation('info.log');

        $this->assertEquals($this->logger->getFileLocation(), 'info.log');
    }

    /** @test */
    public function log_file_is_created(): void
    {
        $this->logger->logSuccess('Test log');

        $this->assertFileExists(__DIR__ . '/../../test.log');
    }

    /** @test */
    public function log_file_contains_success_message(): void
    {
        $this->logger->logSuccess('Test success');
        $record = '[' . date('Y-m-d H:i:s') . '] SUCCESS: Test success' . PHP_EOL;
        $fileContent = file_get_contents($this->logger->getFileLocation());

        $this->assertEquals($fileContent, $record);
    }

     /** @test */
     public function log_file_contains_error_message(): void
     {
        $this->logger->logError('Test error');
        $record = '[' . date('Y-m-d H:i:s') . '] ERROR: Test error' . PHP_EOL;
        $fileContent = file_get_contents($this->logger->getFileLocation());

        $this->assertEquals($fileContent, $record);
     }

    /** @test */
    public function console_output_is_visible(): void
    {
        $this->logger->setConsoleOutput(true);
        $this->logger->logSuccess('Test log');

        $record = '[' . date('Y-m-d H:i:s') . '] SUCCESS: Test log' . PHP_EOL;

        $this->expectOutputString($record);
    }

    /** @test */
    public function not_existing_log_level_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->logger->addRecord(3000, 'Error message');
    }

    public function tearDown(): void
    {
        $logFile = $this->logger->getFileLocation();

        if (file_exists($logFile)) {
            unlink($logFile);
        }
    }
}