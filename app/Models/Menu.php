<?php

namespace App\Models;

use App\Helper\CurrencyHelper;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Menu extends Model
{
    use Sortable;
    
    /**
     * The attributes that are mass asignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'name', 'number', 'comment', 'price', 'payed'
    ];

    /**
     * The attributes that are sortable in tables.
     *
     * @var array
     */
    public $sortable = [
        'name', 'number', 'price', 'created_at', 'updated_at'
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
            ->sortable(['updated_at' => 'desc']);
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
        return CurrencyHelper::Format(
            $query->where('user_id', $userID)->sum('price')
        );
    }
}
