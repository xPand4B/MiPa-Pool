<?php

namespace MiPaPo\Core\Components\Common\Testing;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require base_path('src/Core/src/Resources/public/app.php');

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
