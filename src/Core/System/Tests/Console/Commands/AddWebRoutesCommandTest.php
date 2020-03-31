<?php

namespace MiPaPo\Core\System\Tests\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\System\Tests\ComponentTestTrait;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group System
 */
class AddWebRoutesCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->addWebRoutes();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_adds_web_route_file(): void
    {
        $countBefore = $this->countFilesByName('Routes/web.php');
        $this->addWebRoutes();

        $countAfter = $this->countFilesByName('Routes/web.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /**
     * Runs the add:web-routes command.
     */
    private function addWebRoutes(): void
    {
        $this->artisan('add:web-routes', [
            'component' => $this->sampleComponentName
        ]);
    }
}
