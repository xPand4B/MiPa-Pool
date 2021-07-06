<?php

namespace App\MiPaPo;

class MiPaPo
{
    public static function logEverythingUsing(string $callback): void
    {
        app()->singleton(MiPaPoLogger::class, $callback);
    }
}
