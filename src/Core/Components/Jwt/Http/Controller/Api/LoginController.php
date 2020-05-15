<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Http\Resources\ErrorResource;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;

class LoginController extends JwtBaseController
{
    /**
     * @var array
     */
    const LOGIN_CREDENTIALS = [
        'email',
        'password'
    ];

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return array|JsonResponse
     */
    public function login(Request $request)
    {
        // TODO: GH-40 - Add event here

        $credentials = $this->getCredentials($request, self::LOGIN_CREDENTIALS);

        // Credentials are invalid
        if ($credentials instanceof JsonResponse) {
            // TODO: GH-40 - Add event here
            return $credentials;
        }

        $token = auth('api')->attempt($credentials);

        if (! $token) {
            // TODO: GH-40 - Add event here
            return (new ErrorResource())
                ->setStatusCode(401)
                ->setTitle('Invalid credentials')
                ->setDetail('There is no user matching these credentials.')
                ->setSource('/auth', null)
                ->getError();
        }

        $response = response()->token($token);

        // TODO: GH-40 - Add event here

        return $response;
    }
}
