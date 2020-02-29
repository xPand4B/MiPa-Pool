<?php

namespace App\Components\Order\Database;

use App\Components\Common\Traits\HasSeeder;
use App\Components\Common\Traits\UsesUuid;
use App\Components\Menu\Database\Menu;
use App\Components\User\Database\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Order extends Model
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
     * Get the user that created the order.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set to many menus per order.
     *
     * @return HasMany
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Scope a query to only include orders that are open/not closed.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeOpen(Builder $query)
    {
        return $query->where('closed', false);
    }

    /**
     * Scope a query to only include orders that are closed.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeClosed(Builder $query)
    {
        return $query->where('closed', true);
    }

    /**
     * Scope a query to get all orders from the specified user.
     *
     * @param Builder $query
     * @param Uuid $userId
     *
     * @return Builder
     */
    public function scopeFromUser(Builder $query, Uuid $userId)
    {
        return $query
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'desc');
    }

    /**
     * Scope a query to get a count for orders per current month.
     *
     * @param Builder $query
     * @param Uuid $userId
     *
     * @return int
     */
    public function scopeCurrentMonth(Builder $query, Uuid $userId)
    {
        return $query
            ->where('user_id', $userId)
            ->whereMonth('created_at', date('m'))
            ->count();
    }
}
