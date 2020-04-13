<?php

namespace MiPaPo\Core\Tests\System\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
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
        $this->makeController();

        $controller = CoreComponentHelper::getFilesByDirectory(
            'Http'.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.$this->sampleComponentName.'Controller.php'
        );

        $test = CoreComponentHelper::getFilesByDirectory(
            'Tests'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.$this->sampleComponentName.'ControllerTest.php'
        );

        self::assertTrue(file_exists($controller[0]));
        self::assertTrue(file_exists($test[0]));

        $this->deleteSampleComponent();
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
