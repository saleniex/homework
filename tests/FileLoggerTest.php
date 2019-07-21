<?php

namespace Tests;

use Homework\FileLogger;

const ROOT = __DIR__ . "/../";

class LoggerTest extends AbstractLoggerTest
{
    private $fullFileName = ROOT . 'application.log';
    private $logger;

    public function __construct()
    {
        $this->logger = new FileLogger();

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
     * @group logfile1
     * @group logsuccess
     */
    public function testLogFileCreatedOnSuccess(): void
    {
        $this->logger->logSuccess($this->getSuccessMessage());

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
        $this->logger->logSuccess($this->getSuccessMessage());

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
        $this->logger->logError($this->getErrorMessage());

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
        $this->logger->logError($this->getErrorMessage());

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
}
