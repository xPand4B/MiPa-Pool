<?php

namespace App\Providers;

use App\Components\Common\MiPaPo;
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
                MiPaPo::ComponentPath('User/' . config('mipapo.path.factories'))
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
            MiPaPo::ComponentPath('Common/' . config('mipapo.path.database'))
        );

        $this->loadMigrationsFrom(MiPaPo::getMigrationDirectories());
    }
}
