<?php

namespace MiPaPo\Core\Tests;

use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class CoreBundleTest extends TestCase
{
    /** @test */
    public function test_class_is_facade(): void
    {
        // TODO: Add test
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
        // TODO: Add test
    }

    /** @test */
    public function test_all_seeders_can_be_get(): void
    {
        // TODO: Add test
    }
}
