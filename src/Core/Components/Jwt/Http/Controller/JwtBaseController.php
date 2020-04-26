<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Http\Resources\ErrorResource;
use MiPaPo\Core\Components\Common\Http\Resources\TokenResource;
use MiPaPo\Core\Components\Common\Repositories\GenericRepository;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Resources\UserResource;
use MiPaPo\Core\Controller\Controller;
use MiPaPo\Core\CoreBundle;

class JwtBaseController extends Controller
{
    /**
     * @array
     */
    const LOGIN_CREDENTIALS = [
        'email',
        'password'
    ];

    /**
     * @var GenericRepository
     */
    protected $userRepository;

    /**
     * Create a new JwtBaseController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [ 'login' ]
        ]);

        $this->userRepository = (new GenericRepository(UserResource::class, User::class));
    }

    /**
     * Returns the credentials from the request.
     * If credentials are missing an error will be generated.
     *
     * @param Request $request
     * @return array|JsonResponse
     */
    protected function getCredentials(Request $request)
    {
        $hasErrors = false;
        $errors = new ErrorResource();

        foreach (self::LOGIN_CREDENTIALS as $credential) {
            if (! $request->has($credential)) {
                $hasErrors = true;

                $errors->addError(
                    null,
                    null,
                    401,
                    null,
                    'Invalid credentials',
                    'The '.$credential.' field is required.',
                    '/auth/credentials/'.$credential,
                    null,
                    null
                );
            }
        }

        if ($hasErrors) {
            return $errors
                ->setStatusCode(401)
                ->getErrorCollection();
        }

        return $request->only(self::LOGIN_CREDENTIALS);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return TokenResource::GenerateResponse(
            $token, auth()->factory()->getTTL() * config('jwt.ttl')
        );
    }
}