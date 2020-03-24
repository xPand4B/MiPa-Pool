<?php

namespace MiPaPo\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
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
