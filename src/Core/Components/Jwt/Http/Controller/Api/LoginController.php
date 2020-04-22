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
        $credentials = $this->getCredentials($request);

        // credentials are invalid
        if ($credentials instanceof JsonResponse) {
            return $credentials;
        }

        $token = auth('api')->attempt($credentials);

        if (! $token) {
            return (new ErrorResource())
                ->setStatusCode(401)
                ->setTitle('')
                ->setDetail('')
                ->setSource('', '')
                ->getError();
        }

        return $this->respondWithToken($token);
    }


}
