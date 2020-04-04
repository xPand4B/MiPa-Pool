<?php

namespace MiPaPo\Core\Helper;

use MiPaPo\Core\CoreBundle;
use Illuminate\Support\Facades\File;

// TODO: Make Class a Facade
class CoreComponentHelper
{
    /**
     * Returns a count of all components.
     *
     * @param bool $includeCommon
     * @return int
     */
    public static function getCount(bool $includeCommon = false): int
    {
        return sizeof(self::getDirectories($includeCommon));
    }

    /**
     * Returns all component names.
     *
     * @param string $additionalPath
     * @param bool $includeCommon
     * @return array
     */
    public static function getNames(string $additionalPath = null, bool $includeCommon = false): array
    {
        $directories = self::getDirectories($includeCommon);

        if ($additionalPath) {
            foreach ($directories as $key => $directory) {
                $directories[$key] = $directory . DIRECTORY_SEPARATOR . $additionalPath;
            }
        }

        return $directories;
    }

    /**
     * Returns all component files matching the search term.
     *
     * @param string $search
     * @param bool $includeCommon
     * @return array
     */
    public static function getFilesByDirectory(string $search, bool $includeCommon = false): array
    {
        $files = [];

        foreach (self::getDirectories($includeCommon) as $dir) {
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
     * Get all component directories .
     *
     * @param bool $includeCommon
     * @return array
     */
    private static function getDirectories(bool $includeCommon = false): array
    {
        $components = File::directories(CoreBundle::ComponentPath());

        if ($includeCommon) {
            return $components;
        }

        $components = preg_grep('/Common/', $components, PREG_GREP_INVERT);

        return $components;
    }
}
