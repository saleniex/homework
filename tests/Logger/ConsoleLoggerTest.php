<?php

namespace Tests\Logger;

use Homework\Logger\ConsoleLogger;

class ConsoleLoggerTest extends AbstractLoggerTest
{
    private $loggerClass;

    public function __construct()
    {
        $this->loggerClass = ConsoleLogger::class;

        parent::__construct();
    }

    /**
     * @group logconsole
     * @group logsuccess
     */
    public function testSuccessLog()
    {
        $logger = $this->getLogger(
            $this->loggerClass,
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
            $this->loggerClass,
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
}