<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream,
    org\bovigo\vfs\vfsStreamDirectory;

use Homework\ReferenceLogger;

/**
 * Class ReferenceLoggerIntegrationTestCase
 */
final class ReferenceLoggerIntegrationTestCase extends TestCase
{
    /**
     * @var  vfsStreamDirectory
     */
    private $root;


    final public function setUp(): void
    {
        $this->root = vfsStream::setup('referenceLoggerIntegration');
    }

    final public function testLogError(): void
    {
        $fileName = $this->root->url() . '/error.log';

        $l = new ReferenceLogger($fileName);
        $l->logError("message1");
        $this->assertEquals("ERROR: message1", file_get_contents($fileName), "Message written");

        $l->logError("message2");
        $this->assertEquals("ERROR: message2", file_get_contents($fileName), "Message overwritten");
    }

    final public function testLogSuccess(): void
    {
        $fileName = $this->root->url() . '/success.log';

        $l = new ReferenceLogger($fileName);
        $l->logSuccess("message1");
        $this->assertEquals("SUCCESS: message1", file_get_contents($fileName), "Message written");

        $l->logSuccess("message2");
        $this->assertEquals("SUCCESS: message1SUCCESS: message2", file_get_contents($fileName), "Message appended");
    }
}