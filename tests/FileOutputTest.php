<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class FileOutputTest extends TestCase
{
    private $file = __DIR__ . '/tmp/file.log';

    private $invalidFile = __DIR__ . '/tmp';

    public function getOutput()
    {
        return new FileOutput($this->file);
    }

    public function testImplementsOutputInterface()
    {
        $this->assertInstanceOf(
            'OutputInterface',
            $this->getOutput()
        );
    }

    public function testCanWriteAndAppendMessageToFile()
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }

        $output = $this->getOutput();
        $output->write('Message 1', 'level');
        $output->write('Message 2', 'level');

        $actual = file_get_contents($this->file);
        unlink($this->file);

        $expected = 'Message 1' . "\n" . 'Message 2' . "\n";
        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException OutputException
     */
    public function testThrowsExceptionOnWriteError()
    {
        $output = new FileOutput($this->invalidFile);
        $output->write('Message', 'level');
    }
}
