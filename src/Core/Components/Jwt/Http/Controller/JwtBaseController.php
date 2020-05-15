<?php

namespace MiPaPo\Core\Components\Jwt\Http\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Http\Resources\ErrorResource;
use MiPaPo\Core\Components\Common\Repositories\GenericRepository;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Resources\UserResource;
use MiPaPo\Core\Controller\Controller;

class JwtBaseController extends Controller
{
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
        $this->userRepository = (new GenericRepository(UserResource::class, User::class));
    }

    /**
     * Returns the credentials from the request.
     * If credentials are missing an error will be generated.
     *
     * @param Request $request
     * @param array $credentialSet
     * @return array|JsonResponse
     */
    protected function getCredentials(Request $request, array $credentialSet)
    {
        $hasErrors = false;
        $errors = new ErrorResource();

        foreach ($credentialSet as $credential) {
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

        return $request->only($credentialSet);
    }
}