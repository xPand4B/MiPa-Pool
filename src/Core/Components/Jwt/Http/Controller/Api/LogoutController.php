<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller\Api;

use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Http\Resources\MessageResource;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;
use MiPaPo\Core\CoreBundle;

class LogoutController extends JwtBaseController
{
    /**
     * Logout user and invalidate token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // TODO: GH-40 - Add event here

        auth()->logout(true);

        // TODO: GH-40 - Add event here

        $response = MessageResource::GenerateResponse(
            'Successfully logged out.'
        );

        // TODO: Refactor to core resource

        return $response;
    }
}
