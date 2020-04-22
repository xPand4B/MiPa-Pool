<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;

class MeController extends JwtBaseController
{
    /**
     * Get the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return $this->repo->getById($request, $user->id);
    }

    /**
     * Refresh a token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request)
    {
        return $this->respondWithToken(
            auth()->refresh()
        );
    }
}
