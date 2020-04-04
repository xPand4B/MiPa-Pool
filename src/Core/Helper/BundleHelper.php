<?php

namespace MiPaPo\Core\Helper;

// TODO: Make Class a Facade
use Illuminate\Support\Facades\File;

class BundleHelper
{
    /**
     * Returns all bundle names.
     *
     * @param string $additionalPath
     * @return array
     */
    public static function getNames(string $additionalPath = null): array
    {
        $directories = self::getDirectories();

        if (!$additionalPath) {
            return $directories;
        }

        $additionalPath = str_replace('/', DIRECTORY_SEPARATOR, $additionalPath);
        $additionalPath = str_replace('\\', DIRECTORY_SEPARATOR, $additionalPath);

        foreach ($directories as $key => $directory) {
            $temp = $directory . DIRECTORY_SEPARATOR . $additionalPath;

            if (!file_exists($temp)) {
                unset($directories[$key]);
                continue;
            }

            $directories[$key] = $directory . DIRECTORY_SEPARATOR . $additionalPath;
        }

        return $directories;
    }

    /**
     * Returns all bundle files matching the search term.
     *
     * @param string $search
     * @param string $bundleName
     * @return array
     */
    public static function getFilesByDirectory(string $search, string $bundleName = ''): array
    {
        $files = [];

        foreach (self::getDirectories() as $dir) {
            $file = $dir.DIRECTORY_SEPARATOR.$search;
            $file = str_replace('/', DIRECTORY_SEPARATOR, $file);
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

            if (!file_exists($file)) {
                continue;
            }

            array_push($files, $file);
        }

        return $files;
    }

    /**
     * Get all bundle directories .
     *
     * @return array
     */
    private static function getDirectories(): array
    {
        $bundles = [];
        $directories = scandir(base_path('src'));

        foreach ($directories as $key => $dir) {
            if (pathinfo($dir, PATHINFO_EXTENSION)){
                continue;
            }

            if ($dir === '.' || $dir === '..' || $dir === 'vendor') {
                continue;
            }

            array_push($bundles, base_path('src'.DIRECTORY_SEPARATOR.$dir));
        }

        return $bundles;
    }
}