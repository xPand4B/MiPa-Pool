<?php

namespace MiPaPo\Core\System\Exceptions;

use Illuminate\Auth\AuthenticationException;
use MiPaPo\Core\Components\Common\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     *
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     *
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $parameter = explode('/', $request->fullUrl());
            $parameter = $parameter[sizeof($parameter) - 1];

            $model = explode('\\', $exception->getModel());
            $model = mb_strtolower($model[sizeof($model) - 1]);

            return (new ErrorResource())
                ->setSource('/database/models/'.$model, $parameter)
                ->setDetail("Entry for '".$model."' not found.")
                ->setStatusCode(404)
                ->getError();
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $unauthenticatedResponse = (new ErrorResource())
            ->setTitle('Authentication error')
            ->setDetail('You are not authenticated.')
            ->setSource('/auth', null)
            ->setStatusCode(401)
            ->getError();

        return $request->expectsJson()
            ? $unauthenticatedResponse
            : redirect()->guest($exception->redirectTo() ?? route('auth.login'));
    }
}
