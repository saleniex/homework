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
        static::assertTrue(false);
    }

    /**
     * @group logconsole
     * @group logerror
     */
    public function testErrorLog()
    {
        static::assertTrue(false);
    }
}