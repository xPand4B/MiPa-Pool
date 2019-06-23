<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use Sortable;

    /**
     * The attributes that are mass asignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'delivery_service', 'site_link', 'deadline', 'minimum_value', 'max_orders', 'closed'
    ];

    /**
     * The attributes that are sortable in tables.
     *
     * @var array
     */
    public $sortable = [
        'name', 'delivery_service', 'deadline', 'created_at'
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
    public function scopeOpen(Builder $query)
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
    public function scopeClosed(Builder $query)
    {
        return $query->where('closed', true);
    }

    /**
     * Scope a query to get all orders from the specified user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userID
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromUser(Builder $query, int $userID)
    {
        return $query
            ->where('user_id', $userID)
            ->sortable(['created_at' => 'desc']);
    } 

    /**
     * Scope a query to get a count for orders per current month.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userID
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentMonth(Builder $query, int $userID)
    {
        return $query
            ->where('user_id', $userID)
            ->whereMonth('created_at', date('m'))
            ->count();
    } 
}
