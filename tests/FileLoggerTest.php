<?php

namespace Tests;

use Homework\FileLogger;
use Homework\Formatter\Formatter;

class LoggerTest extends AbstractLoggerTest
{
    private $fullFileName;
    private $logger;

    public function __construct()
    {
        $this->fullFileName  = __DIR__ . "/../" . 'application.log';
        $this->logger = new FileLogger(new Formatter);

        parent::__construct();
    }

    public function setUp() : void
    {
        //If the log file exists, remove it
        if (file_exists($this->fullFileName)) {
            unlink($this->fullFileName);
        }
    }

    /**
     * @group logfile
     * @group logsuccess
     */
    public function testLogFileCreatedOnSuccess(): void
    {
        $logger = $this->getLogger(
            $this->getExpectedSuccessMessage()
        );
        $logger->logSuccess(
            $this->getSuccessMessage()
        );

        static::assertFileExists(
            $this->fullFileName,
            "No log file was created!"
        );
    }

    /**
     * @group logfile
     * @group logsuccess
     */
    public function testLogContentOnSuccess(): void
    {
        $logger = $this->getLogger(
            $this->getExpectedSuccessMessage()
        );
        $logger->logSuccess(
            $this->getSuccessMessage()
        );

        $fileContents = $this->getFileContentsIfFileExists($this->fullFileName);

        static::assertStringContainsString(
            $this->getExpectedSuccessMessage(),
            $fileContents
        );
    }

    /**
     * @group logfile
     * @group logerror
     */
    public function testLogFileCreatedOnError(): void
    {
        $logger = $this->getLogger(
            $this->getExpectedErrorMessage()
        );
        $logger->logError(
            $this->getErrorMessage()
        );

        static::assertFileExists(
            $this->fullFileName,
            "No log file was created!"
        );
    }

    /**
     * @group logfile
     * @group logerror
     */
    public function testLogContentOnError(): void
    {
        $logger = $this->getLogger(
            $this->getExpectedErrorMessage()
        );
        $logger->logError(
            $this->getErrorMessage()
        );

        $fileContents = $this->getFileContentsIfFileExists($this->fullFileName);

        static::assertStringContainsString(
            $this->getExpectedErrorMessage(),
            $fileContents
        );
    }

    /**
     * Returns contents of file if file exists, null if it doesn't
     * @param string $fileName
     *
     * @return string|null
     */
    protected function getFileContentsIfFileExists(string $fileName)
    {
        if (file_exists($fileName)) {
            return file_get_contents($fileName);
        }

        return null;
    }

    /**
     * Return logger with mocked formatter
     * @param string $message
     *
     * @return FileLogger
     */
    protected function getLogger(string $message) : FileLogger
    {
        $mockedFormatter = $this->createMock(Formatter::class);
        $mockedFormatter->method('format')->willReturn($message);
        $logger = new FileLogger($mockedFormatter);

        return $logger;
    }
}
