<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller\Api;

use Illuminate\Http\Request;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;

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
        auth()->logout();

        // TODO: Change response
        return response()->json([
            'Successfully logged out'
        ]);
    }
}
