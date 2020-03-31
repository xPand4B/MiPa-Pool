<?php

namespace MiPaPo\Core\System\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use MiPaPo\Core\Helper\BundleHelper;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Config::set('frontend', base_path('src/Frontend/Resources/config/frontend.php'));
    }
}
