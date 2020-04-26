<?php

namespace MiPaPo\Core\Components\Common\Http\Resources;

use Illuminate\Http\JsonResponse;
use MiPaPo\Core\CoreBundle;

// TODO: Add Resource core class + extend from it
class TokenResource
{
    /**
     * Generate token response.
     *
     * @param string $token
     * @param int $expiresIn
     * @param string $tokenType
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function GenerateResponse(
        string $token,
        int $expiresIn,
        string $tokenType = 'bearer',
        int $status = 200
    ): JsonResponse
    {
        return response()->json([
            'data' => [
                'type' => 'token',
                'attributes' => [
                    'access_token' => $token,
                    'token_type' => $tokenType,
                    'expires_in' => $expiresIn,
                    'status' => $status
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ]);
    }
}