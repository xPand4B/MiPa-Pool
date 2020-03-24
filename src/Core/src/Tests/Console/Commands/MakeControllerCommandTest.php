<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Components\Common\Testing\TestCase;

/**
 * @group App
 */
class MakeControllerCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeController();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_controller_and_test(): void
    {
        $countBefore = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeController();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleControllerName(),
            $this->getSampleControllerName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeController();
        $sampleFile = CoreComponentHelper::getFilesByName($this->getSampleControllerName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$this->getSampleControllerName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:controller command.
     */
    private function makeController(): void
    {
        $this->artisan('make:controller', [
            'name' => $this->getSampleControllerName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample controller class name.
     *
     * @return string
     */
    private function getSampleControllerName(): string
    {
        return $this->sampleComponentName . 'Controller';
    }
}
