<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the user that created the order
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
