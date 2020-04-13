<?php

namespace MiPaPo\Core\Tests\System\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class MakeTestCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeTest();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_unit_tests(): void
    {
        $this->makeTest();

        $test = CoreComponentHelper::getFilesByDirectory(
            'Tests'.DIRECTORY_SEPARATOR.$this->sampleComponentName.'Test.php'
        );

        self::assertTrue(file_exists($test[0]));

        $this->deleteSampleComponent();
    }

    /**
     * Runs the make:test command.
     */
    private function makeTest(): void
    {
        $this->artisan('make:test', [
            'name' => $this->getSampleUnitTestName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample resource class name.
     *
     * @return string
     */
    private function getSampleUnitTestName(): string
    {
        return $this->sampleComponentName . 'Test';
    }
}
