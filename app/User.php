<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'surname', 'email', 'about_me', 'password',
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
     * Set user to many orders.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Set user to many menus
     */
    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
}
