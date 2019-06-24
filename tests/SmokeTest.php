<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

const ROOT = __DIR__ . "/../";

/**
 * Class SmokeTest
 */
final class SmokeTest extends TestCase
{
    final public function testReferenceOutput(): void
    {
        $resultFileName = ROOT . "application.log";
        if (file_exists($resultFileName)) {
            unlink($resultFileName);
        }

        include(ROOT . "index.php");


        $this->assertEquals("ERROR: Error message #2SUCCESS: Success message.",
            file_get_contents($resultFileName), "File contains reference data.");

        unlink($resultFileName);
    }
}