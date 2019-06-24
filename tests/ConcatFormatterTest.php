<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;


/**
 * Class ConcatFormatterTest
 */
final class ConcatFormatterTest extends TestCase
{
    final public function testFormat(): void
    {
        $formatter = new \Homework\Format\ConcatFormatter();

        $this->assertEquals("level: message", $formatter->format("message", "level"));
    }
}