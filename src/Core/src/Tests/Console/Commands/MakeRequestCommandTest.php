<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class MakeRequestCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeRequest();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_request_and_test(): void
    {
        $countBefore = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeRequest();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = CoreComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleRequestName(),
            $this->getSampleRequestName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeRequest();
        $sampleFile = CoreComponentHelper::getFilesByName($this->getSampleRequestName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Requests'.DIRECTORY_SEPARATOR.$this->getSampleRequestName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:request command.
     */
    private function makeRequest(): void
    {
        $this->artisan('make:request', [
            'name' => $this->getSampleRequestName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample request class name.
     *
     * @return string
     */
    private function getSampleRequestName(): string
    {
        return $this->sampleComponentName . 'Request';
    }
}
