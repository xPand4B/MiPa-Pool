<?php

namespace MiPaPo\Core\Components\Common\Tests\Traits;

use MiPaPo\Core\Components\Common\Traits\UsesUuid;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class UsesUuidTest extends TestCase
{
    use UsesUuid;

    /** @test */
    public function test_trait_has_incrementing_set_to_false(): void
    {
        self::assertFalse($this->getIncrementing());
    }

    /** @test */
    public function test_trait_has_correct_key_type(): void
    {
        self::assertSame('string', $this->getKeyType());
    }
}
