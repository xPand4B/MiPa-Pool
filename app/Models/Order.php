<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass asignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'delivery_service', 'site_link', 'deadline', 'minimum_value', 'max_orders', 'closed'
    ];

    /**
     * Get the user that created the order.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Set to many menus per order.
     */
    public function menus()
    {
        return $this->hasMany(\App\Models\Menu::class);
    }

    /**
     * Scope a query to only include orders that are open/not closed.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {
        return $query->where('closed', false);
    }

    /**
     * Scope a query to only include orders that are closed.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClosed($query)
    {
        return $query->where('closed', true);
    }   

    /**
     * Scope a query to get a count for orders per current month.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userID
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentMonth($query, int $userID)
    {
        return $query->where('user_id', $userID)
                        ->whereMonth('created_at', date('m'))
                        ->count();
    }
}
