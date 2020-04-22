<?php

namespace MiPaPo\Core\Testing;

use Illuminate\Foundation\Application;
use MiPaPo\Core\System\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../System/Bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
