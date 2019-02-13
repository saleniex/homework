<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class ConsoleOutputTest extends TestCase
{
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
}
