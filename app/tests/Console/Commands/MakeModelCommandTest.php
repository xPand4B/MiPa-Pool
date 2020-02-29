<?php

namespace App\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\tests\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group App
 */
class MakeModelCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeModel();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_model(): void
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleModelName());
        $this->makeModel();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleModelName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleModelName()], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 1);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeModel();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleModelName());
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
