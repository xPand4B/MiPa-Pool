<?php

namespace MiPaPo\Core\Tests\Console\Commands;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;
use Illuminate\Support\Facades\File;

/**
 * @group Core
 */
class MakeMiddlewareCommandTest extends TestCase
{
    use ComponentTestTrait;

    /**
     * @var string
     */
    private $middlewarePath = 'Common/Http/Middleware';

    /** @test */
    public function test_command_makes_no_component(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeMiddleware();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleMiddleware();

        self::assertSame($countAfter, $countBefore);
    }

    /** @test */
    public function test_command_makes_middleware(): void
    {
        $filesBefore = File::allFiles(
            CoreBundle::ComponentPath($this->middlewarePath)
        );

        $this->makeMiddleware();

        $filesAfter = File::allFiles(
            CoreBundle::ComponentPath($this->middlewarePath)
        );

        $this->deleteSampleMiddleware();

        self::assertSame(sizeof($filesAfter), sizeof($filesBefore) + 1);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeMiddleware();
        $middlewareFiles = File::allFiles(
            CoreBundle::ComponentPath($this->middlewarePath)
        );
        $this->deleteSampleMiddleware();

        foreach ($middlewareFiles as $file) {
            if ($file->getBasename() === $this->getSampleMiddlewareName().'.php') {
                self::assertStringContainsString(
                    'Common'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Middleware'.DIRECTORY_SEPARATOR.$this->getSampleMiddlewareName(),
                    $file->getPathname()
                );
            }
        }
    }

    /**
     * Runs the make:middleware command.
     */
    private function makeMiddleware(): void
    {
        $this->artisan('make:middleware', [
            'name' => $this->getSampleMiddlewareName()
        ]);
    }

    /**
     * Deletes the sample middleware class.
     */
    private function deleteSampleMiddleware(): void
    {
        File::delete(
            CoreBundle::ComponentPath('Common/Http/Middleware').DIRECTORY_SEPARATOR.$this->getSampleMiddlewareName().'.php'
        );
    }

    /**
     * Returns the sample middleware class name.
     *
     * @return string
     */
    private function getSampleMiddlewareName(): string
    {
        return $this->sampleComponentName . 'Middleware';
    }
}
