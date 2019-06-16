<?php

namespace App\Models;

use App\Helper\Currency;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass asignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'name', 'number', 'comment', 'price'
    ];

    /**
     * Get the user that added the menu.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the order for the created menu.
     */
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    /**
     * Scope a query to get all money spend so far.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userID
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMoneySpend($query, int $userID)
    {
        return Currency::Format(
            $query->where('user_id', $userID)->sum('price')
        );
    }
}
