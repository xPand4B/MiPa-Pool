<?php

namespace MiPaPo\Core\Components\Common\Http\Resources;

use Illuminate\Http\JsonResponse;
use MiPaPo\Core\CoreBundle;

// TODO: Add Resource core class + extend from it
class MessageResource
{
    /**
     * Generate message response.
     *
     * @param string $message
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function GenerateResponse(
        string $message,
        int $status = 200
    ): JsonResponse
    {
        return response()->json([
            'data' => [
                'type' => 'message',
                'attributes' => [
                    'message' => $message,
                    'status' => $status
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ]);
    }
}