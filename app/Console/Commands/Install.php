<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Install extends Command
{
    protected $signature = 'install {--dev : Install in dev-mode.}';

    protected $description = 'Install the Application.';

    public function handle(): void
    {
        $mode = $this->option('dev') ? 'dev' : 'prod';

        $commands = [
            'cp .env.example .env',
            'php artisan key:generate --ansi',
            'php artisan migrate:fresh --force',
            'php artisan storage:link',
            'npm install',
            "npm run $mode"
        ];


        foreach ($commands as $command) {
            $process = new Process(explode(' ', $command));
            $process->start();
            $iterator = $process->getIterator($process::ITER_SKIP_ERR | $process::ITER_KEEP_OUTPUT);

            foreach ($iterator as $data) {
                echo $data;
            }
            $this->line('');
        }
    }
}
