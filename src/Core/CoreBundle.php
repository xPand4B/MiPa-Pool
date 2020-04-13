<?php

namespace MiPaPo\Core;

use MiPaPo\Core\Helper\CoreComponentHelper;
use Illuminate\Support\Facades\File;

class CoreBundle
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
    public const VERSION = "2.0.0";

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
            config('core.path.component') . $path
        );
    }

    /**
     * Returns all migration directories.
     *
     * @return array
     */
    public static function getMigrationDirectories(): array
    {
        return CoreComponentHelper::getNames(
            config('core.path.migrations'), true
        );
    }

    /**
     * Get all component seeder classes.
     *
     * @return array
     */
    public static function getComponentSeeders(): array
    {
        $seederPaths = CoreComponentHelper::getNames(config('core.path.seeds'));
        $seeders = [];

        foreach ($seederPaths as $path) {
            if (!is_dir($path)) {
                continue;
            }

            $files = File::allFiles($path);

            foreach ($files as $file) {
                $classname = $file->getFilenameWithoutExtension();
                $component = explode(DIRECTORY_SEPARATOR, $file->getRealPath());
                $component = $component[sizeof($component) - 4];

                $namespace = 'MiPaPo\Core\Components\\' . $component . '\Database\Seeds\\' . $classname;

                array_push($seeders, $namespace);
            }
        }

        return $seeders;
    }
}
