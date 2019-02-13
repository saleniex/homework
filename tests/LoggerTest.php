<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    public function testImplementsLoggerInterface()
    {
        $this->assertInstanceOf(
            'LoggerInterface',
            new Logger(new DummyOutput)
        );
    }

    public function testCanBeCreatedStaticallyByGet()
    {
        $this->assertInstanceOf(
            Logger::class,
            Logger::get()
        );
    }

    /**
     * @dataProvider provideLevelsAndMessages
     */
    public function testCanLogAtLevel($level, $message)
    {
        $output = new DummyOutput;

        $logger = new Logger($output);
        $logger->{'log' . ucfirst($level)}($message);
        $logger->logMessage($level, $message);

        $expected = [
            strtoupper($level) . ': Message of level ' . $level,
            strtoupper($level) . ': Message of level ' . $level,
        ];

        $this->assertEquals($expected, $output->getMessages());
    }

    public function provideLevelsAndMessages()
    {
        return [
            LogLevel::ERROR => [LogLevel::ERROR, 'Message of level error'],
            LogLevel::SUCCESS => [LogLevel::SUCCESS, 'Message of level success'],
        ];
    }
}
