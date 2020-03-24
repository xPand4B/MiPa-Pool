<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Components\Common\Testing\TestCase;

/**
 * @group App
 */
class MakeRepositoryCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeRepository();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_repository_plus_model_and_test(): void
    {
        $countBefore = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeRepository();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleRepositoryName(),
            $this->getSampleRepositoryName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeRepository();
        $sampleFile = CoreComponentHelper::getFilesByName($this->getSampleRepositoryName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Repositories'.DIRECTORY_SEPARATOR.$this->getSampleRepositoryName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:repository command.
     */
    private function makeRepository(): void
    {
        $this->artisan('make:repository', [
            'name' => $this->getSampleRepositoryName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample repository class name.
     *
     * @return string
     */
    private function getSampleRepositoryName(): string
    {
        return $this->sampleComponentName . 'Repository';
    }
}
