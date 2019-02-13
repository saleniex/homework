<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class ConsoleOutputTest extends TestCase
{
    private $file = __DIR__ . '/tmp/file.log';

    public function getOutput()
    {
        return new ConsoleOutput();
    }

    public function testImplementsOutputInterface()
    {
        $this->assertInstanceOf(
            'OutputInterface',
            $this->getOutput()
        );
    }

    /**
     * @dataProvider provideLevelsAndMessages
     */
    public function testCanWriteAtLevel($level, $message)
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }

        $output = $this->getOutput();
        $streamMap = new ReflectionProperty($output, 'streamMap');
        $streamMap->setAccessible(true);
        $streamMap->setValue($output, [
            LogLevel::ERROR => $this->file,
            LogLevel::SUCCESS => $this->file,
        ]);

        $output->write($message, $level);

        $actual = file_get_contents($this->file);
        unlink($this->file);

        $expected = 'Message of level ' . $level;
        if ($level == LogLevel::ERROR) {
            $expected = sprintf("\033[01;31m%s\033[0m", $expected);
        }
        $expected .= "\n";

        $this->assertEquals($expected, $actual);
    }

    public function provideLevelsAndMessages()
    {
        return [
            LogLevel::ERROR => [LogLevel::ERROR, 'Message of level error'],
            LogLevel::SUCCESS => [LogLevel::SUCCESS, 'Message of level success'],
        ];
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidLevel()
    {
        $output = $this->getOutput();;
        $output->write('Message', 'invalid level');
    }
}
