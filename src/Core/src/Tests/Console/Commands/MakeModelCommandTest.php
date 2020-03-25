<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class MakeModelCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeModel();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_model(): void
    {
        $countBefore = CoreComponentHelper::getFilesByName($this->getSampleModelName());
        $this->makeModel();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = CoreComponentHelper::getFilesByName($this->getSampleModelName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleModelName()], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 1);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeModel();
        $sampleFile = CoreComponentHelper::getFilesByName($this->getSampleModelName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.$this->getSampleModelName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:model command.
     */
    private function makeModel(): void
    {
        $this->artisan('make:model', [
            'name' => $this->getSampleModelName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample model class name.
     *
     * @return string
     */
    private function getSampleModelName(): string
    {
        return $this->sampleComponentName . 'Model';
    }
}
