<?php

namespace MiPaPo\Core\Components\Common\Helper;

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
        return sizeof(self::getComponentDirectories($includeCommon));
    }

    /**
     * Returns all component names.
     *
     * @param string $additionalPath
     * @param bool $includeCommon
     * @return array
     */
    public static function getComponentNames(string $additionalPath = null, bool $includeCommon = false): array
    {
        $directories = self::getComponentDirectories($includeCommon);

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
    public static function getFilesByName(string $search, bool $includeCommon = false): array
    {
        $files = [];

        foreach (self::getComponentDirectories($includeCommon) as $component_directory) {
            $component_files = File::allFiles($component_directory);
            foreach ($component_files as $file) {
                if (strpos($file->getFilename(), $search) !== false) {
                    array_push($files, $file->getPathname());
                }
            }
        }

        return $files;
    }

    /**
     * Get all component directories .
     *
     * @param bool $includeCommon
     * @return array
     */
    private static function getComponentDirectories(bool $includeCommon = false): array
    {
        $components = File::directories(CoreBundle::ComponentPath());

        if ($includeCommon) {
            return $components;
        }

        foreach ($components as $key => $component) {
            if (strpos($component, 'Common')) {
                unset($components[$key]);
                break;
            }
        }

        return $components;
    }
}
