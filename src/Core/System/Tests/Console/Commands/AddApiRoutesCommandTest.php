<?php

namespace MiPaPo\Core\System\Tests\Console\Commands;

use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\System\Tests\ComponentTestTrait;

/**
 * @group System
 */
class AddApiRoutesCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = CoreComponentHelper::getCount();
        $this->addApiRoutes();

        $countAfter = CoreComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_adds_api_route_file(): void
    {
        $countBefore = $this->countFilesByName('Routes/api.php');
        $this->addApiRoutes();

        $countAfter = $this->countFilesByName('Routes/api.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /**
     * RUns the add:api-routes command.
     */
    private function addApiRoutes(): void
    {
        $this->artisan('add:api-routes', [
            'component' => $this->sampleComponentName
        ]);
    }
}
