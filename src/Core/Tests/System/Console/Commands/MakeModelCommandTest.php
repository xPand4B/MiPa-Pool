<?php

namespace MiPaPo\Core\Tests\System\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
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
        $this->makeModel();

        $model = CoreComponentHelper::getFilesByDirectory(
            'Database/'.$this->sampleComponentName.'Model.php'
        );

        self::assertTrue(file_exists($model[0]));

        $this->deleteSampleComponent();
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
