<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\Tests\ComponentTestTrait;

/**
 * @group Core
 */
class MakeFactoryCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeFactory();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_controller_and_test(): void
    {
        $countBefore = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeFactory();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleFactoryName(),
            $this->getSampleFactoryName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeFactory();
        $sampleFile = CoreComponentHelper::getFilesByName($this->getSampleFactoryName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.'factories'.DIRECTORY_SEPARATOR.$this->getSampleFactoryName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:factory command.
     */
    private function makeFactory(): void
    {
        $this->artisan('make:factory', [
            'name' => $this->getSampleFactoryName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample controller class name.
     *
     * @return string
     */
    private function getSampleFactoryName(): string
    {
        return $this->sampleComponentName . 'Factory';
    }
}
