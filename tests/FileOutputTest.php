<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class FileOutputTest extends TestCase
{
    public function getOutput()
    {
        return new FileOutput('file.log');
    }

    public function testImplementsOutputInterface()
    {
        $this->assertInstanceOf(
            'OutputInterface',
            $this->getOutput()
        );
    }
}
