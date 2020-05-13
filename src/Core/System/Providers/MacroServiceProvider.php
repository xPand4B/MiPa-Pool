<?php

namespace MiPaPo\Core\System\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use MiPaPo\Core\Components\Common\Http\Resources\ResourceBuilder;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMessageResponse();
        $this->registerTokenResponse();
    }

    /**
     * Register the "message" macro on the request.
     *
     * @return void
     */
    private function registerMessageResponse(): void
    {
        ResponseFactory::macro('message', function(string $message, int $status = 200): JsonResponse
        {
            return (new ResourceBuilder)
                ->setData('message', [
                    'message' => $message,
                    'status' => $status
                ])
                ->getResponse();
        });
    }

    /**
     * Register the "token" macro on the request.
     *
     * @return void
     */
    private function registerTokenResponse(): void
    {
        ResponseFactory::macro('token', function(string $token): JsonResponse
        {
            $expiresIn = auth()->factory()->getTTL() * config('jwt.ttl');

            return (new ResourceBuilder())
                ->setData('token', [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $expiresIn,
                    'status' => 200,
                ])
                ->getResponse();
        });
    }
}
