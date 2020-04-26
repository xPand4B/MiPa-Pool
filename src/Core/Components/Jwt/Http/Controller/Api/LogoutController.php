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
        auth()->logout(true);

        // TODO: Refactor to core resource
        return MessageResource::GenerateResponse(
            'Successfully logged out.'
        );
    }
}
