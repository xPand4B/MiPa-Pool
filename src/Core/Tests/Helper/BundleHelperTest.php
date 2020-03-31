<?php

namespace MiPaPo\Core\Tests;

use Illuminate\Support\Facades\File;
use MiPaPo\Core\Helper\BundleHelper;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class BundleHelperTest extends TestCase
{
    /** @test */
    public function test_helper_can_get_bundle_names(): void
    {
        $directories = File::directories(base_path('src'));
        $directories = preg_grep('/vendor/', $directories, PREG_GREP_INVERT);

        $bundleNames = BundleHelper::getNames();

        self::assertSame($directories, $bundleNames);
    }

    /** @test */
    public function test_helper_can_get_bundle_names_with_additional_path(): void
    {
        $directories = $this->getBundleDirectories();

        foreach ($directories as $key => $dir) {
            if (!file_exists($dir.DIRECTORY_SEPARATOR.'Resources')) {
                unset($directories[$key]);
                continue;
            }

            $directories[$key] .= DIRECTORY_SEPARATOR.'Resources';
        }

        $bundleNames = BundleHelper::getNames('Resources');

        self::assertSame($directories, $bundleNames);
    }

    /** @test */
    public function test_helper_can_get_files_by_directory(): void
    {
        $actual = $this->getBundleDirectories();

        foreach ($actual as $key => $file) {
            $file .= DIRECTORY_SEPARATOR.'README.md';

            if (!file_exists($file)) {
                unset($actual[$key]);
            }

            $actual[$key] = $file;
        }

        $files = BundleHelper::getFilesByDirectory('README.md');

        self::assertSame($actual, $files);
    }

    /** @test */
    public function test_helper_can_get_files_by_directory_from_core_bundle(): void
    {
        $actual = realpath(base_path('src/Core/README.md'));
        $file = BundleHelper::getFilesByDirectory('README.md', 'Core');

        self::assertSame($actual, $file[0]);
    }

    /**
     * Returns all bundle directories
     *
     * @return array
     */
    private function getBundleDirectories(): array
    {
        $directories =  File::directories(base_path('src'));
        $directories = preg_grep('/vendor/', $directories, PREG_GREP_INVERT);

        return $directories;
    }
}
