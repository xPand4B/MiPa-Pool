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
            'Http/Controller/'.$this->sampleComponentName.'Controller.php'
        );

        $test = CoreComponentHelper::getFilesByDirectory(
            'Tests/Http/Controller/'.$this->sampleComponentName.'ControllerTest.php'
        );

        self::assertTrue(file_exists($controller[0]));
        self::assertTrue(file_exists($test[0]));

        $this->deleteSampleComponent();
    }

    /** @test */
    public function test_controller_can_be_made_with_different_options(): void
    {
        $options = [
            'parent' => 'Components\\Common\\Http\\Controller\\Api\\MiPaPoApiController',
            'model' => 'Components\\User\\Database\\User',
            'invokable' => null,
            'resource' => null,
        ];

        foreach ($options as $option => $value) {
            $this->makeControllerWithOption($option, $value);

            $controller = CoreComponentHelper::getFilesByDirectory(
                'Http/Controller/'.$this->sampleComponentName.'Controller.php'
            );

            $test = CoreComponentHelper::getFilesByDirectory(
                'Tests/Http/Controller/'.$this->sampleComponentName.'ControllerTest.php'
            );

            self::assertTrue(file_exists($controller[0]));
            self::assertTrue(file_exists($test[0]));

            $this->deleteSampleComponent();
        }

        $this->artisan('make:controller', [
            'name' => $this->getSampleControllerName(),
            'component' => $this->sampleComponentName,
            '--resource' => 'default',
            '--api' => 'default',
        ]);

        $controller = CoreComponentHelper::getFilesByDirectory(
            'Http/Controller/'.$this->sampleComponentName.'Controller.php'
        );

        $test = CoreComponentHelper::getFilesByDirectory(
            'Tests/Http/Controller/'.$this->sampleComponentName.'ControllerTest.php'
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
     * Runs the make:controller command.
     *
     * @param string $option
     * @param string $value
     */
    private function makeControllerWithOption(string $option, $value): void
    {
        if ($value === null) {
            $value = 'default';
        }

        $this->artisan('make:controller', [
            'name' => $this->getSampleControllerName(),
            'component' => $this->sampleComponentName,
            '--'.$option => $value
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
