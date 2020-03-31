<?php

namespace MiPaPo\Core\Components\User\Http\Controller\Api;

use MiPaPo\Core\Components\Common\Http\Controller\Api\MiPaPoApiController;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserApiController extends MiPaPoApiController
{
    /**
     * Set the Resource for json responses.
     *
     * @return String
     */
    protected function setResource(): String
    {
        return UserResource::class;
    }

    /**
     * Set the Model for this api endpoint.
     *
     * @return String
     */
    protected function setModel(): String
    {
        return User::class;
    }

    /**
     * Set the values that should be stored after the store route is called.
     *
     * @param Request $request
     *
     * @return array
     */
    protected function setStoreValues(Request $request): array
    {
        $initials = $request->get('firstname')[0].$request->get('lastname')[0];

        return [
            'username' => $request->get('username'),
            'firstname' => $request->get('firstname'),
            'initials' => $initials,
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'avatar' => $request->get('avatar'),
            'birthday' => $request->get('birthday'),
            'remember_token' => Str::random(40),
            'password' => bcrypt($request->get('password')),
        ];
    }

    /**
     * Set the validation rules.
     *
     * @return array
     */
    protected function setValidationRules(): array
    {
        return [
            'username'  => 'required|min:3|max:255|alpha_num|unique:users',
            'firstname' => 'required|min:1|max:255|alpha',
            'lastname'  => 'required|min:1|max:255|alpha',
            'email'     => 'required|max:255|email|unique:users',
            'avatar'    => 'nullable',
            'locale'    => 'nullable',
            'darkmode'  => 'boolean',
            'birthday'  => 'nullable|date',
            'password'  => 'required|min:8|max:255|confirmed',
        ];
    }

    /**
     * OPTIONAL: Set the custom validation messages.
     *
     * @return array
     */
    protected function setValidationMessages(): array
    {
        return [];
    }

    /**
     * OPTIONAL: Set custom validation attributes.
     *
     * @return array
     */
    protected function setValidationCustomAttributes(): array
    {
        return [];
    }
}
