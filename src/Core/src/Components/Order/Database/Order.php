<?php

namespace MiPaPo\Core\Components\Order\Database;

use MiPaPo\Core\Components\Common\Traits\HasSeeder;
use MiPaPo\Core\Components\Common\Traits\UsesUuid;
use MiPaPo\Core\Components\Menu\Database\Menu;
use MiPaPo\Core\Components\User\Database\User;
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
    const TABLE_NAME = 'orders';

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
}
