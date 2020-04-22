<?php

namespace MiPaPo\Core\Components\User\Tests\Http\Controller\Api;

use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Http\Controller\Api\MiPaPoApiController;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Controller\Api\UserApiController;
use MiPaPo\Core\Components\User\Http\Resources\UserResource;
use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;

/**
 * @group UserCoreComponent
 */
class UserApiControllerTest extends TestCase
{
    use UserTestCaseTrait;

    /**
     * @param string $method
     * @param array $methodArgs
     *
     * @return mixed
     * @throws \ReflectionException
     */
    private function getInvokedMethod(string $method, array $methodArgs = [])
    {
        return self::invokeMethod(
            UserApiController::class, $method, $methodArgs, new UserApiController()
        );
    }

    /** @test */
    public function test_api_controller_extends_correct_class(): void
    {
        self::assertClassExtendsClass(
            UserApiController::class, MiPaPoApiController::class
        );
    }

    /** @test */
    public function test_resource_is_set(): void
    {
        $method = $this->getInvokedMethod('setResource');

        self::assertSame(UserResource::class, $method);
    }

    /** @test */
    public function test_model_is_set(): void
    {
        $method = $this->getInvokedMethod('setModel');

        self::assertSame(User::class, $method);
    }

    /** @test */
    public function test_store_validation_is_set(): void
    {
        $request = new Request([
            'username' => 'xPand',
            'firstname' => 'Eric',
            'lastname' => 'Heinzl',
            'email' => 'xpand.4beatz@gmail.com'
        ]);

        $method = $this->getInvokedMethod('setStoreValues', [$request]);

        self::assertArrayHasKey('remember_token', $method);
        self::assertArrayHasKey('password', $method);

        unset($method['remember_token']);
        unset($method['password']);

        self::assertSame([
            'username' => 'xPand',
            'firstname' => 'Eric',
            'lastname' => 'Heinzl',
            'initials' => 'EH',
            'email' => 'xpand.4beatz@gmail.com',
            'avatar' => null,
            'birthday' => null,
        ], $method);
    }

    /** @test */
    public function test_validation_rules_are_set(): void
    {
        $method = $this->getInvokedMethod('setValidationRules');

        self::assertSame([
            'username'  => 'required|min:3|max:255|alpha_num|unique:users',
            'firstname' => 'required|min:1|max:255|alpha',
            'lastname'  => 'required|min:1|max:255|alpha',
            'email'     => 'required|max:255|email|unique:users',
            'avatar'    => 'nullable',
            'locale'    => 'nullable',
            'darkmode'  => 'boolean',
            'birthday'  => 'nullable|date',
            'password'  => 'required|min:8|max:255|confirmed',
        ], $method);
    }

    /** @test */
    public function test_validation_messages_are_set(): void
    {
        $method = $this->getInvokedMethod('setValidationMessages');

        self::assertSame([
            // nth
        ], $method);
    }

    /** @test */
    public function test_custom_validation_attributes_are_set(): void
    {
        $method = $this->getInvokedMethod('setValidationCustomAttributes');

        self::assertSame([
            // nth
        ], $method);
    }
}
