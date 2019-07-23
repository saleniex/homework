<?php

declare(strict_types=1);

namespace Tests\Formatter;

use PHPUnit\Framework\TestCase;
use Homework\Formatter\Formatter;

class FormatterTestCase extends TestCase
{
    /**
     * @group formatter
     * @group concat
     */
    public function testFormat()
    {
        static::assertEquals(
            "Prefix: Message",
            (new Formatter())->format("Prefix", "Message")
        );
    }
}