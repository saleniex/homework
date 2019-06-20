<?PHP

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

const ROOT = __DIR__ . "/../";

/**
 * Class IntegrationTestCase
 */
final class IntegrationTestCase extends TestCase
{
    final public function testReferenceOutput(): void
    {
        include(ROOT . "index.php");

        $resultFileName = ROOT . "/application.log";

        $this->assertEquals("ERROR: Error message #2SUCCESS: Success message.",
            file_get_contents($resultFileName), "File contains reference data.");
    }

}