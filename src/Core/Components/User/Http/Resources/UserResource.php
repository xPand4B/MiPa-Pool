<?php

namespace MiPaPo\Core\Components\User\Http\Resources;

use MiPaPo\Core\Components\Common\Http\Resources\BaseResource;

class UserResource extends BaseResource
{
    /**
     * Returns the resource table.
     *
     * @return String
     */
    protected function getTable(): String
    {
        return 'users';
    }

    /**
     * Returns the resource type.
     *
     * @return String
     */
    protected function getType(): String
    {
        return 'user';
    }

    /**
     * Returns the resource attributes.
     *
     * @param $request
     * @return array
     */
    protected function getAttributes($request): array
    {
        return [
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'initials' => $this->initials,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'avatar' => $this->avatar,
            'preferences' => [
                'locale' => $this->locale,
                'darkmode' => (boolean)$this->darkmode,
            ],
//            'email_verified_at' => $this->email_verified_at,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Returns the resource relations.
     *
     * @param $request
     * @return array
     */
    protected function getRelations($request): array
    {
        // TODO: Add relationships
        return [
            'orders' => null,
            'menus' => null,
        ];
    }

    /**
     * Returns the resource links.
     *
     * @param $request
     * @return array
     */
    protected function getLinks($request): array
    {
        // TODO: Add related links
        return [
            'self' => route('user.show', [$this->getId()]),
            'related' => null,
        ];
    }
}
