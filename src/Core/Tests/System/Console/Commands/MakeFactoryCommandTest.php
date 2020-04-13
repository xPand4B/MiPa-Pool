<?php

namespace MiPaPo\Core\Tests\System\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
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
        $this->makeFactory();

        $factory = CoreComponentHelper::getFilesByDirectory(
            'Database'.DIRECTORY_SEPARATOR.'factories'.DIRECTORY_SEPARATOR.$this->sampleComponentName.'Factory.php'
        );

        $test = CoreComponentHelper::getFilesByDirectory(
            'Tests'.DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.'factories'.DIRECTORY_SEPARATOR.$this->sampleComponentName.'FactoryTest.php'
        );

        self::assertTrue(file_exists($factory[0]));
        self::assertTrue(file_exists($test[0]));

        $this->deleteSampleComponent();
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
