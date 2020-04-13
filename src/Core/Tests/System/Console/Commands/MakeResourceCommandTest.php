<?php

namespace MiPaPo\Core\Tests\System\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class MakeResourceCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeResource();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_resource_and_test(): void
    {
        $this->makeResource();

        $resource = CoreComponentHelper::getFilesByDirectory(
            'Http'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.$this->sampleComponentName.'Resource.php'
        );

        $test = CoreComponentHelper::getFilesByDirectory(
            'Tests'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.$this->sampleComponentName.'ResourceTest.php'
        );

        self::assertTrue(file_exists($resource[0]));
        self::assertTrue(file_exists($test[0]));

        $this->deleteSampleComponent();
    }

    /**
     * Runs the make:resource command.
     */
    private function makeResource(): void
    {
        $this->artisan('make:resource', [
            'name' => $this->getSampleResourceName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample resource class name.
     *
     * @return string
     */
    private function getSampleResourceName(): string
    {
        return $this->sampleComponentName . 'Resource';
    }
}
