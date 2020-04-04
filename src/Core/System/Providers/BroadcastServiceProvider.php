<?php

namespace MiPaPo\Core\System\Providers;

use MiPaPo\Core\CoreBundle;
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

        require CoreBundle::ComponentPath('Common/routes/channels.php');
    }
}
