<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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

        return $this->userRepository->getById(
            $request, $user->id
        );
    }

    /**
     * Refresh a token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request)
    {
        $newToken = auth()->refresh(true, true);

        return $this->respondWithToken($newToken);
    }

    /**
     * Update the user resource in storage.
     *
     * @param Request $request
     * @param string $id
     *
     * @return bool|JsonResponse|JsonResource
     */
    public function update(Request $request)
    {
        $user = $request->user();

        return $this->userRepository->update(
            $request, $user
        );
    }
}
