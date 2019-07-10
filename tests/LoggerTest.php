<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once 'Logger.php';

final class LoggerTest extends TestCase
{
    public function testErrorMessage(): void
    {
		$message = "This is an error message";

		$logger = new Logger();
        $logger
            ->clearLog()
            ->logError($message)
            ;
		$content = file_get_contents($logger->fileLocation);
		$this->assertContains($message, $content);
    }

    public function testSuccessMessage(): void
    {
		$message = "This is a success message";

		$logger = new Logger();
        $logger
            ->clearLog()
            ->logSuccess($message)
            ;
		$content = file_get_contents($logger->fileLocation);
		$this->assertContains($message, $content);
    }

    public function testUnsupportedLogMessageType(): void
    {
        $this->expectException(InvalidArgumentException::class);
	
		$logger = new Logger();
		$logger->logMessage("wrongType", "Won't work");
    }
}

