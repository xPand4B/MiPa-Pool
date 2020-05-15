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
        // TODO: GH-40 - Add event here

        $user = $request->user();

        $response =  $this->userRepository->getById(
            $request, $user->id
        );

        // TODO: GH-40 - Add event here

        return $response;
    }

    /**
     * Refresh a token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request)
    {
        // TODO: GH-40 - Add event here

        $newToken = auth()->refresh(true, true);

        $response = response()->token($newToken);

        // TODO: GH-40 - Add event here

        return $response;
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
        // TODO: GH-40 - Add event here

        $user = $request->user();

        $response = $this->userRepository->update(
            $request, $user
        );

        // TODO: GH-40 - Add event here

        return $response;
    }
}
