<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass asignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'menu', 'number', 'comment', 'price'
    ];

    /**
     * Get the user that added the menu.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the order for the created menu.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
