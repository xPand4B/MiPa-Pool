<?php

namespace App\Components\Common;

use App\Components\Common\Helper\ComponentHelper;
use Illuminate\Support\Facades\File;

// TODO: Make Class a Facade
class MiPaPo
{
    /**
     * Api Version.
     *
     * @var string
     */
    public const API_VERSION = "1.0";

    /**
     * MiPaPo Version.
     *
     * @var string
     */
    public const APP_VERSION = "v2.0.0";

    /**
     * The redirect url after a successful login.
     *
     * @var string
     */
    public const REDIRECT_TO_URL_AFTER_LOGIN = '/';

    /**
     * Returns the component path.
     *
     * @param string|null $path
     * @return string
     */
    public static function ComponentPath(string $path = null): string
    {
        if (!is_null($path)) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

            if ($path[0] !== '/' || $path[0] !== '\\') {
                $path = DIRECTORY_SEPARATOR . $path;
            }
        }

        return base_path(
            config('mipapo.path.component') . $path
        );
    }

    /**
     * Returns all migration directories.
     *
     * @return array
     */
    public static function getMigrationDirectories(): array
    {
        return ComponentHelper::getComponentNames(
            config('mipapo.path.migrations'), true
        );
    }

    /**
     * Get all component seeder classes.
     *
     * @return array
     */
    public static function getComponentSeeders(): array
    {
        $seederPaths = ComponentHelper::getComponentNames(config('mipapo.path.seeds'));
        $seeders = [];

        foreach ($seederPaths as $path) {
            if (is_dir($path)) {
                $files = File::allFiles($path);

                foreach ($files as $file) {
                    $classname = $file->getFilenameWithoutExtension();
                    $component = explode(DIRECTORY_SEPARATOR, $file->getRealPath());
                    $component = $component[sizeof($component) - 4];

                    $namespace = 'App\Components\\' . $component . '\Database\Seeds\\' . $classname;

                    array_push($seeders, $namespace);
                }
            }
        }

        return $seeders;
    }
}
