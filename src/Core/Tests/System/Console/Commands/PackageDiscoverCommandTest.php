<?php

namespace MiPaPo\Core\Tests\System\Console\Commands;

use MiPaPo\Core\System\Console\Commands\PackageDiscoverCommand;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class PackageDiscoverCommandTest extends TestCase
{
    /**
     * @covers PackageDiscoverCommand::VENDOR_PATH
     */
    public function test_command_has_correct_vendor_path(): void
    {
        self::assertSame(
            'src/vendor', PackageDiscoverCommand::VENDOR_PATH
        );
    }
}
