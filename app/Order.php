<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass asignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'site_link', 'deadline', 'delivery_service', 'max_orders'
    ];

    /**
     * Get the user that created the order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Set to many menus per order.
     */
    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
}
