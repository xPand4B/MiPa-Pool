<?php

namespace MiPaPo\Core\Components\User\Database;

use MiPaPo\Core\Components\Common\Traits\HasSeeder;
use MiPaPo\Core\Components\Common\Traits\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UsesUuid, HasSeeder;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'users';

    /**
     * @var array
     */
    const VALIDATION_RULES = [
        'username'  => 'required|min:3|max:255|alpha_num|unique:users',
        'firstname' => 'required|min:1|max:255|alpha',
        'lastname'  => 'required|min:1|max:255|alpha',
        'email'     => 'required|max:255|email|unique:users',
        'avatar'    => 'nullable',
        'locale'    => 'nullable',
        'darkmode'  => 'boolean',
        'birthday'  => 'nullable|date',
        'password'  => 'required|min:5|max:255|confirmed',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'firstname',
        'lastname',
        'initials',
        'email',
        'birthday',
        'avatar',
        'locale',
        'darkmode',
        'password',
        'api_token',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
