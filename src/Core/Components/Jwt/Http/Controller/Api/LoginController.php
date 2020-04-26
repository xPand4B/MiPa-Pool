<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Http\Resources\ErrorResource;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;

class LoginController extends JwtBaseController
{
    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return array|JsonResponse
     */
    public function login(Request $request)
    {
        // TODO: GH-40 - Add event here

        $credentials = $this->getCredentials($request);

        // credentials are invalid
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

        $response = $this->respondWithToken($token);

        // TODO: GH-40 - Add event here

        return $response;
    }
}
