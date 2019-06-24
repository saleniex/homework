<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;


/**
 * Class FancyFormatterTest
 */
final class FancyFormatterTest extends TestCase
{
    final public function testFormat(): void
    {
        $formatter = new \Homework\Format\FancyFormatter();

        $this->assertEquals("[level]: message\n", $formatter->format("message", "level"));
    }
}