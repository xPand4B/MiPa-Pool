<?php

namespace App\Components\Menu\Database;

use App\Components\Common\Traits\HasSeeder;
use App\Components\Common\Traits\UsesUuid;
use App\Components\Order\Database\Order;
use App\Components\User\Database\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use UsesUuid, HasSeeder;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * Get the user that added the menu.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order for the created menu.
     *
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Scope a query to get all orders from the specified user.
     *
     * @param Builder $query
     * @param int $userID
     *
     * @return Builder
     */
    public function scopeFromUser(Builder $query, int $userID)
    {
        return $query
            ->where('user_id', $userID)
            ->orderBy('updated_at', 'desc');
    }

    /**
     * Scope a query to get all money spend so far.
     *
     * @param Builder $query
     * @param int $userID
     *
     * @return Builder
     */
    public function scopeMoneySpend($query, int $userID)
    {
        return CurrencyHelper::Format(
            $query->where('user_id', $userID)->sum('price')
        );
    }
}
