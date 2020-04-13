<?php

namespace MiPaPo\Core\Tests;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use MiPaPo\Core\Controller\Controller;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group Core
 */
class ControllerTest extends TestCase
{
    /** @test */
    public function test_controller_has_correct_traits(): void
    {
        $traits = [
            AuthorizesRequests::class,
            DispatchesJobs::class,
            ValidatesRequests::class,
        ];

        self::assertClassHasTrait(
            Controller::class, $traits
        );
    }
}
