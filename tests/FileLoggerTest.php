<?php

declare(strict_types=1);

use Homework\FileLogger;
use PHPUnit\Framework\TestCase;
const ROOT = __DIR__ . "/../";

class LoggerTest extends TestCase
{
    private $successMessage = 'successMessage';
    private $errorMessage = 'errorMessage';
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
     * @group logfile
     * @group logsuccess
     */
    public function testLogFileCreatedOnSuccess(): void
    {
        $this->logger->logSuccess($this->successMessage);

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
        $this->logger->logSuccess($this->successMessage);
        $successMessagePrefix = 'SUCCESS:';

        $fileContents = $this->getFileContentsIfFileExists($this->fullFileName);

        static::assertStringContainsString(
            sprintf("%s %s", $successMessagePrefix, $this->successMessage),
            $fileContents
        );
    }

    /**
     * @group logfile
     * @group logerror
     */
    public function testLogFileCreatedOnError(): void
    {
        $this->logger->logError($this->errorMessage);

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
        $this->logger->logError($this->errorMessage);
        $ErrorMessagePrefix = 'ERROR:';

        $fileContents = $this->getFileContentsIfFileExists($this->fullFileName);

        static::assertStringContainsString(
            sprintf("%s %s", $ErrorMessagePrefix, $this->errorMessage),
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
