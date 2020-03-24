<?php

namespace MiPaPo\Core\Providers;

use MiPaPo\Core\CoreBundle;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EloquentFactory::class, function ($app) {
            $faker = $app->make(FakerGenerator::class);
            return EloquentFactory::construct(
                $faker,
                CoreBundle::ComponentPath('User/' . config('core.path.factories'))
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->databasePath(
            CoreBundle::ComponentPath('Common/' . config('core.path.database'))
        );

        $this->loadMigrationsFrom(CoreBundle::getMigrationDirectories());
    }
}
