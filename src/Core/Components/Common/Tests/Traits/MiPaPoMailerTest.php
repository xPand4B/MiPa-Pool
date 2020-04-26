<?php

namespace MiPaPo\Core\Components\Common\Tests\Traits;

use MiPaPo\Core\Components\Common\Traits\MiPaPoMailer;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class MiPaPoMailerTest extends TestCase
{
    use MiPaPoMailer;

    /** @test */
    public function test_trait_has_all_required_properties(): void
    {
        self::assertNull($this->user);
        self::assertNull($this->token);
        self::assertNull($this->greeting);
        self::assertSame('primary', $this->level);
        self::assertSame([], $this->introLines);
        self::assertNull($this->actionText);
        self::assertNull($this->actionUrl);
        self::assertSame([], $this->outroLines);
        self::assertNull($this->salutation);
    }

    /** @test */
    public function test_trait_has_all_required_setter(): void
    {
        $setters = [
            [
                'setter' => 'setToken',
                'property' => 'token',
                'default' => null,
                'sample' => 'Sample',
            ],
            [
                'setter' => 'greeting',
                'property' => 'greeting',
                'default' => null,
                'sample' => 'Sample',
            ],
            [
                'setter' => 'level',
                'property' => 'level',
                'default' => 'primary',
                'sample' => 'Sample',
            ],
            [
                'setter' => 'introLines',
                'property' => 'introLines',
                'default' => [],
                'sample' => ['Sample'],
            ],
            [
                'setter' => 'outroLines',
                'property' => 'outroLines',
                'default' => [],
                'sample' => ['Sample'],
            ],
            [
                'setter' => 'salutation',
                'property' => 'salutation',
                'default' => null,
                'sample' => 'Sample',
            ],
        ];

        foreach ($setters as $item) {
            $setter = $item['setter'];
            $property = $item['property'];
            $default = $item['default'];
            $sampleValue = $item['sample'];

            self::assertSame($default, $this->{$property});
            $this->{$setter}($sampleValue);
            self::assertSame($sampleValue, $this->{$property});
        }

        self::assertNull($this->actionText);
        self::assertNull($this->actionUrl);

        $this->action('sampleText', 'sampleUrl');

        self::assertSame('sampleText', $this->actionText);
        self::assertSame('sampleUrl', $this->actionUrl);
    }
}
