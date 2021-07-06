<?php

namespace App\Actions\MiPaPo;

use App\MiPaPo\MiPaPoLogger;
use Illuminate\Support\Facades\Log;

class DefaultLogger implements MiPaPoLogger
{
    public function alert(string $message, array $context = []): void
    {
        Log::alert($message, $context);
    }

    public function critical(string $message, array $context = []): void
    {
        Log::critical($message, $context);
    }

    public function debug(string $message, array $context = []): void
    {
        Log::debug($message, $context);
    }

    public function emergency(string $message, array $context = []): void
    {
        Log::emergency($message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        Log::error($message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }

    public function log($level, string $message, array $context = []): void
    {
        Log::log($level, $message, $context);
    }

    public function notice(string $message, array $context = []): void
    {
        Log::notice($message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        Log::warning($message, $context);
    }

    public function write(string $level, string $message, array $context = []): void
    {
        Log::write($level, $message, $context);
    }

    public function listen(\Closure $callback): void
    {
        Log::listen($callback);
    }
}
