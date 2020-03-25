<?php

namespace MiPaPo\Core\Components\Common\Tests\Helper;

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\Tests\ComponentTestTrait;
use Illuminate\Support\Facades\File;

/**
 * @group Common
 */
class ComponentHelperTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_helper_can_find_all_component_files(): void
    {
        $this->makeSampleComponent();

        $files = $this->getComponentFiles($this->sampleComponentName);

        for ($i = 0; $i < sizeof($files); $i++) {
            self::assertSame($files[$i], $this->sampleComponentFiles[$i]);
        }

        $this->deleteSampleComponent();
    }

    /** @test */
    public function test_helper_returns_null_if_component_not_exists(): void
    {
        $files = $this->getComponentFiles($this->sampleComponentName . 'Fake');
        $this->deleteSampleComponent();

        self::assertEmpty($files);
    }

    /** @test */
    public function test_helper_can_count_components(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->makeSampleComponent();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_helper_can_get_all_component_names()
    {
        $expected = CoreComponentHelper::getComponentNames();

        $actual = File::directories(CoreBundle::ComponentPath());

        // Minus one because the helper is ignoring the Common component.
        self::assertSame(sizeof($actual) - 1, sizeof($expected));
    }

    /** @test */
    public function test_helper_can_get_all_route_files(): void
    {
        $this->makeSampleComponent();

        $apiRouteFiles = CoreComponentHelper::getFilesByName('api.php');
        $webRouteFiles = CoreComponentHelper::getFilesByName('web.php');

        $this->deleteSampleComponent();

        $sampleRouteFileCount = 0;

        foreach ($apiRouteFiles as $file) {
            $tmp = explode(DIRECTORY_SEPARATOR, $file);
            if ($tmp[sizeof($tmp) - 3] === $this->sampleComponentName) {
                $sampleRouteFileCount++;
            }
        }

        foreach ($webRouteFiles as $file) {
            $tmp = explode(DIRECTORY_SEPARATOR, $file);
            if ($tmp[sizeof($tmp) - 3] === $this->sampleComponentName) {
                $sampleRouteFileCount++;
            }
        }

        self::assertSame(2, $sampleRouteFileCount);
    }

    /**
     * Makes a component.
     */
    private function makeSampleComponent(): void
    {
        $this->artisan('make:component', [
            'name' => $this->sampleComponentName
        ]);
    }
}
