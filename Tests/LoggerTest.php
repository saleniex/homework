<?php
use PHPUnit\Framework\TestCase;

require_once '..\Logger.php';

class LoggerTest extends TestCase
{

    protected $logger;
    const TESTFILELOCATION = __DIR__."/testlog.log";

    protected function setUp()
    {
        $this->logger = new Logger(self::TESTFILELOCATION, false);
    }

    public function testGetloggerInstance()
    {
        $logger = Logger::get('.', true);
        $this->assertTrue($logger instanceof Logger);

        $logger = Logger::get();
        $this->assertTrue($logger instanceof Logger);
    }


    public function testSetOutputToConsole()
    {
        $this->logger->setOutputToConsole(true);

		$reflectionClass = new \ReflectionClass('Logger');

        $reflectionProperty = $reflectionClass->getProperty('logToConsole');
        $reflectionProperty->setAccessible(true);
        $logToConsoleValue = $reflectionProperty->getValue($this->logger);

        $this->assertTrue($logToConsoleValue);
    }

    public function testLogSuccess()
    {
        $message = "This is a succesful log message";

        $date = new DateTime();
        $fullmessage = $this->logger::SUCCESS . ': ' . $message . ' ' . $date->format('Y-m-d H:i:s') . PHP_EOL;

        $logger = $this->logger->logSuccess($message);

        $contents = $this->readTestFile();
        $this->cleanTestFile();

        $this->assertEquals($fullmessage, $contents);
    }

    public function testLogError()
    {
        $message = "This is not a succesful log message";

        $date = new DateTime();
        $fullmessage = $this->logger::ERROR . ': ' . $message . ' ' . $date->format('Y-m-d H:i:s') . PHP_EOL;

        $logger = $this->logger->logError($message);

        $contents = $this->readTestFile();
        $this->cleanTestFile();

        $this->assertEquals($fullmessage, $contents);
    }

    private function readTestFile()
    {
        $handle = fopen(self::TESTFILELOCATION, 'r');
        $contents = fread($handle, filesize(self::TESTFILELOCATION));

        return $contents;
    }

    private function cleanTestFile()
    {
        $handle = fopen(self::TESTFILELOCATION, 'w');
        fwrite($handle, '');
        fclose($handle);
    }
}