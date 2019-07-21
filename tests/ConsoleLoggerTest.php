<?php

namespace Tests;

use Homework\ConsoleLogger;

class ConsoleLoggerTest extends AbstractLoggerTest
{
    private $logger;

    public function __construct()
    {
        $this->logger = new ConsoleLogger;

        parent::__construct();
    }

    /**
     * @group logconsole
     * @group logsuccess
     */
    public function testSuccessLog()
    {
        ob_start();
        $this->logger->logSuccess(
            $this->getSuccessMessage()
        );
        $actual = ob_get_clean();

        $expected = $this->getExpectedSuccessMessage() . "\n";

        static::assertEquals($expected, $actual);
    }

    /**
     * @group logconsole
     * @group logerror
     */
    public function testErrorLog()
    {
        ob_start();
        $this->logger->logError(
            $this->getErrorMessage()
        );
        $actual = ob_get_clean();

        $expected = $this->getExpectedErrorMessage() . "\n";

        static::assertEquals($expected, $actual);
    }
}