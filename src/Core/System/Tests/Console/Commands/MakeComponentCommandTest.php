<?php

namespace MiPaPo\Core\System\Tests\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\System\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;
use Illuminate\Support\Facades\File;

/**
 * @group System
 */
class MakeComponentCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeSampleComponent();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_all_files(): void
    {
        $this->makeSampleComponent();

        $files = $this->getComponentFiles($this->sampleComponentName);

        $sampleMigration = File::allFiles(
            CoreBundle::ComponentPath($this->sampleComponentName.'/'.config('core.path.migrations'))
        )[0]->getFilenameWithoutExtension();

        $this->deleteSampleComponent();

        for ($i = 0; $i < sizeof($files); $i++) {
            self::assertSame($this->sampleComponentFiles[$i], $files[$i]);
        }

        self::assertStringContainsString($this->getMigrationName(), $sampleMigration);
    }

    /** @test */
    public function test_command_makes_api_route_files(): void
    {
        $countBefore = $this->countFilesByName('Routes/api.php');
        $this->makeSampleComponent();

        $countAfter = $this->countFilesByName('Routes/api.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_web_route_files(): void
    {
        $countBefore = $this->countFilesByName('Routes/web.php');
        $this->makeSampleComponent();

        $countAfter = $this->countFilesByName('Routes/web.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /**
     * Runs the make:component command.
     */
    private function makeSampleComponent(): void
    {
        $this->artisan('make:component', [
            'name' => $this->sampleComponentName
        ]);
    }
}
