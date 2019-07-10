<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'surname', 'email', 'about_me', 'avatar', 'password',
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
        return $this->hasMany(\App\Models\Order::class);
    }

    /**
     * Set user to many menus
     */
    public function menus()
    {
        return $this->hasMany(\App\Models\Menu::class);
    }

    /**
     * Get the user's fullname
     */
    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->surname;
    }

    /**
     * Rather or not the current user has orders.
     *
     * @return boolean
     */
    public function hasOrders(): bool
    {
        $hasOrders = Order::where('user_id', $this->id)->count();

        if($hasOrders != 0)
            return true;

        return false;
    }

    /**
     * Rather or not the current user has menus.
     *
     * @return boolean
     */
    public function hasMenus(): bool
    {
        $hasMenus = Menu::where('user_id', $this->id)->count();

        if($hasMenus != 0)
            return true;

        return false;
    }
}
