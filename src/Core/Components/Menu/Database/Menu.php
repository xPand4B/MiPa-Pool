<?php

namespace MiPaPo\Core\Components\Menu\Database;

use MiPaPo\Core\Components\Common\Traits\HasSeeder;
use MiPaPo\Core\Components\Common\Traits\UsesUuid;
use MiPaPo\Core\Components\Order\Database\Order;
use MiPaPo\Core\Components\User\Database\User;
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
    const TABLE_NAME = 'menus';

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
}
