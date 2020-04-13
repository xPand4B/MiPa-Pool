<?php

namespace MiPaPo\Core\Tests;

use Illuminate\Support\Facades\File;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class CoreBundleTest extends TestCase
{
    /** @test */
    public function test_class_has_all_required_constants(): void
    {
        $class = new \ReflectionClass(CoreBundle::class);

        self::assertTrue($class->hasConstant('API_VERSION'));
        self::assertTrue($class->hasConstant('VERSION'));
        self::assertTrue($class->hasConstant('REDIRECT_TO_URL_AFTER_LOGIN'));
    }

    /** @test */
    public function test_component_path_exists(): void
    {
        $componentPath = CoreBundle::ComponentPath();

        self::assertSame(true, is_dir($componentPath));
    }

    /** @test */
    public function test_all_migrations_can_be_get(): void
    {
        $expected = CoreBundle::getMigrationDirectories();

        $actual = CoreComponentHelper::getNames(
            config('core.path.migrations'), true
        );

        self::assertSame($expected, $actual);
    }

    /** @test */
    public function test_all_seeders_can_be_get(): void
    {
        $seedDirectories = CoreComponentHelper::getFilesByDirectory('Database/seeds');
        $actual = CoreBundle::getComponentSeeders();
        $counter = 0;

        foreach ($seedDirectories as $directory) {
            $files = File::files($directory);

            foreach ($files as $file) {
                $file = $file->getFilenameWithoutExtension();
                $componentName = str_replace('Seeder', '', $file);
                $expected = 'MiPaPo\Core\Components\\'.$componentName.'\Database\Seeds\\'.$file;

                self::assertSame($expected, $actual[$counter]);
                $counter++;
            }
        }
    }
}
