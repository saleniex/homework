<?php

namespace Tests;

use Homework\Logger\ConsoleLogger;
use Homework\Formatter\NewlineFormatter;
class ConsoleLoggerTest extends AbstractLoggerTest
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @group logconsole
     * @group logsuccess
     */
    public function testSuccessLog()
    {
        $logger = $this->getLogger(
            $this->getExpectedSuccessMessage()
        );

        ob_start();
        $logger->logSuccess(
            $this->getSuccessMessage()
        );
        $actual = ob_get_clean();

        $expected = $this->getExpectedSuccessMessage();

        static::assertEquals($expected, $actual);
    }

    /**
     * @group logconsole
     * @group logerror
     */
    public function testErrorLog()
    {
        $logger = $this->getLogger(
            $this->getExpectedErrorMessage()
        );

        ob_start();
        $logger->logError(
            $this->getErrorMessage()
        );
        $actual = ob_get_clean();

        $expected = $this->getExpectedErrorMessage();

        static::assertEquals($expected, $actual);
    }

    /**
     * Return logger with mocked formatter
     * @param string $message
     *
     * @return ConsoleLogger
     */
    protected function getLogger(string $message) : ConsoleLogger
    {
        $mockedFormatter = $this->createMock(NewlineFormatter::class);
        $mockedFormatter->method('format')->willReturn($message);
        $logger = new ConsoleLogger($mockedFormatter);

        return $logger;
    }
}