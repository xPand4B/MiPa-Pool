<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Components\Common\Testing\TestCase;

/**
 * @group App
 */
class MakeResourceCollectionCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeCollection();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_collection_and_test(): void
    {
        $countBefore = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeCollection();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleCollectionName(),
            $this->getSampleCollectionName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeCollection();
        $sampleFile = CoreComponentHelper::getFilesByName($this->getSampleCollectionName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.$this->getSampleCollectionName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:resource command.
     */
    private function makeCollection(): void
    {
        $this->artisan('make:resource', [
            'name' => $this->getSampleCollectionName(),
            'component' => $this->sampleComponentName,
            'collection'
        ]);
    }

    /**
     * Returns the sample resource class name.
     *
     * @return string
     */
    private function getSampleCollectionName(): string
    {
        return $this->sampleComponentName . 'Collection';
    }
}
