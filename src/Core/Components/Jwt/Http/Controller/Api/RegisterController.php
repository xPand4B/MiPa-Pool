<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;
use MiPaPo\Core\Components\User\Database\User;

class RegisterController extends JwtBaseController
{
    /**
     * @var array
     */
    const REGISTER_CREDENTIALS = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'password_confirmation'
    ];

    /**
     * Registers a user with the given credentials.
     *
     * @param Request $request
     * @return array|bool|JsonResponse
     */
    public function register(Request $request)
    {
        // TODO: GH-40 - Add event here
        $validation = $this->validateUser($request);

        // Credentials are invalid
        if ($validation !== true) {
            // TODO: GH-40 - Add event here
            return $validation;
        }

        $credentials = $this->getCredentials($request, self::REGISTER_CREDENTIALS);

        // TODO: GH-40 - Add event here
        $user = $this->createUser($credentials);
        // TODO: GH-40 - Add event here

        return (new LoginController())
            ->login($request);
    }

    /**
     * Validates the user.
     *
     * @param Request $request
     * @return bool|JsonResponse
     */
    protected function validateUser(Request $request)
    {
        $this->userRepository->setValidationRules(
            User::VALIDATION_RULES
        );

        return $this->userRepository->validate(
            $request->all()
        );
    }

    /**
     * Creates a new user.
     *
     * @param array $credentials
     * @return User
     */
    protected function createUser(array $credentials): User
    {
        $firstname = $credentials['firstname'];
        $lastname = $credentials['lastname'];
        $initials = strtoupper($firstname)[0].strtoupper($lastname)[0];

        return User::create([
            'username' => $credentials['username'],
            'firstname' => $firstname,
            'lastname' => $lastname,
            'initials' => $initials,
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'remember_token' => Str::random(25)
        ]);
    }
}
