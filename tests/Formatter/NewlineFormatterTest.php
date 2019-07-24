<?php

declare(strict_types=1);

namespace Tests\Formatter;

use PHPUnit\Framework\TestCase;
use Homework\Formatter\NewlineFormatter;

class NewlineFormatterTestCase extends TestCase
{
    /**
     * @group formatter
     * @group newline
     */
    public function testFormat() : void
    {
        static::assertEquals(
            "Prefix: Message\n",
            (new NewlineFormatter())->format("Prefix", "Message")
        );
    }
}