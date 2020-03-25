<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
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
        $countBefore = CoreComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->makeTest();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = CoreComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleUnitTestName()], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 1);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeTest();
        $sampleFile = CoreComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Tests'.DIRECTORY_SEPARATOR.$this->getSampleUnitTestName(),
            $sampleFile[0]
        );
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
        return $this->sampleComponentName . 'UnitTest';
    }
}
