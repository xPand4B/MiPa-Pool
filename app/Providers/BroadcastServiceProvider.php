<?php

namespace App\Providers;

use App\Components\Common\MiPaPo;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require MiPaPo::ComponentPath('Common/routes/channels.php');
    }
}
