<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;


/**
 * Class BaseLoggerTest
 */
final class BaseLoggerTest extends TestCase
{
    /**
     * @var \Homework\Output\TestHandler
     */
    private $handler;

    /**
     * @var \Homework\BaseLogger;
     */
    private $logger;


    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new \Homework\Output\TestHandler();
        $this->logger = new \Homework\BaseLogger($this->handler, new  \Homework\Format\ConcatFormatter());
    }

    final public function testLog(): void
    {
        $this->logger->log("message", "level");
        $this->assertEquals(["level: message"], $this->handler->getMessages());

        $this->logger->log("message2", "level2");
        $this->assertEquals(["level: message", "level2: message2"], $this->handler->getMessages(), "Messages get appended");
    }

    final public function testLogError(): void
    {
        $this->logger->logError("message");

        $this->assertEquals(["ERROR: message"], $this->handler->getMessages());
    }

    final public function testLogSuccess(): void
    {
        $this->logger->logSuccess("message");

        $this->assertEquals(["SUCCESS: message"], $this->handler->getMessages());
    }
}