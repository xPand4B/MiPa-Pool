<?php

namespace App\Console\Commands;

use App\Components\Common\MiPaPo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeComponentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:component {name : The name of the component}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new component';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * TODO: Refactor path variables.
     *
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $componentName = \ucfirst(\strtolower($this->argument('name')));

        /*
        |--------------------------------------------------------------------------
        | Make default model, factory and migration
        |--------------------------------------------------------------------------
        */
        $this->call('make:model', [
            'name' => $componentName,
            'component' => $componentName,
            '--factory' => 'default',
            '--migration' => 'default'
        ]);
        $this->createGitKeepFile($componentName.'/Database/factories');
        $this->createGitKeepFile($componentName.'/Database/migrations');

        /*
        |--------------------------------------------------------------------------
        | Make default seeder
        |--------------------------------------------------------------------------
        */
        $this->call('make:seeder', [
            'name' => $componentName.'Seeder',
            'component' => $componentName
        ]);
        $this->createGitKeepFile($componentName.'/Database/seeds');

        /*
        |--------------------------------------------------------------------------
        | Make default api controller
        |--------------------------------------------------------------------------
        */
        $this->call('make:controller', [
            'name' => 'Api\\'.$componentName.'ApiController',
            'component' => $componentName,
            '--api' => 'default'
        ]);
        $this->createGitKeepFile($componentName.'/Http/Controllers');
        $this->createGitKeepFile($componentName.'/Http/Controllers/Api');

        /*
        |--------------------------------------------------------------------------
        | Make default Middleware directory
        |--------------------------------------------------------------------------
        */
        $middlewareDirectory = $componentName.'/Http/Middleware';
        $this->createDirectory($middlewareDirectory);
        $this->createGitKeepFile($middlewareDirectory);

        /*
        |--------------------------------------------------------------------------
        | Make default request
        |--------------------------------------------------------------------------
        */
        $this->call('make:request', [
            'name' => $componentName.'Request',
            'component' => $componentName
        ]);
        $this->createGitKeepFile($componentName.'/Http/Requests');

        /*
        |--------------------------------------------------------------------------
        | Make default resource
        |--------------------------------------------------------------------------
        */
        $this->call('make:resource', [
            'name' => $componentName.'Resource',
            'component' => $componentName
        ]);
        $this->createGitKeepFile($componentName.'/Http/Resources');

        /*
        |--------------------------------------------------------------------------
        | Make default Mail directory
        |--------------------------------------------------------------------------
        */
        $mailDirectory = $componentName.'/Mail';
        $this->createDirectory($mailDirectory);
        $this->createGitKeepFile($mailDirectory);

        /*
        |--------------------------------------------------------------------------
        | Make default Notification directory
        |--------------------------------------------------------------------------
        */
        $notificationDirectory = $componentName.'/Notifications';
        $this->createDirectory($notificationDirectory);
        $this->createGitKeepFile($notificationDirectory);

        /*
        |--------------------------------------------------------------------------
        | Make default repository
        |--------------------------------------------------------------------------
        */
        $repositoryDirectory = $componentName.'/Repositories';
        $this->createDirectory($repositoryDirectory);
        $this->createGitKeepFile($repositoryDirectory);

        /*
        |--------------------------------------------------------------------------
        | Make default api route file
        |--------------------------------------------------------------------------
        */
        $this->call('add:api-routes', [
            'component' => $componentName,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default web route file
        |--------------------------------------------------------------------------
        */
        $this->call('add:web-routes', [
            'component' => $componentName,
        ]);

        return;
    }

    /**
     * Creates a new directory.
     *
     * @param string $directory
     */
    private function createDirectory(string $directory): void
    {
        $path = MiPaPo::ComponentPath($directory);
        File::makeDirectory($path);
    }

    /**
     * Creates an empty .gitkeep file.
     *
     * @param string $directory
     */
    private function createGitKeepFile(string $directory): void
    {
        $path = MiPaPo::ComponentPath($directory.DIRECTORY_SEPARATOR.'.gitkeep');
        \touch($path);
    }
}
