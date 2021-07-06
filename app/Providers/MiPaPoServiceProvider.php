<?php

namespace App\Providers;

use App\Actions\MiPaPo\DefaultLogger;
use App\MiPaPo\MiPaPo;
use Illuminate\Support\ServiceProvider;

class MiPaPoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        MiPaPo::logEverythingUsing(DefaultLogger::class);
    }
}
