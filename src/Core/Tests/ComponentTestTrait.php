<?php

namespace MiPaPo\Core\Tests;

use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\CoreBundle;
use Illuminate\Support\Facades\File;

trait ComponentTestTrait
{
    /**
     * @var string
     */
    public $sampleComponentName = 'Sample';

    /**
     * @var array
     */
    public $sampleComponentFiles = [
        'Sample',
        'SampleFactory',
        'SampleSeeder',
        'SampleApiController',
        'SampleRequest',
        'SampleResource',
        'SampleFactoryTest',
        'SampleApiControllerTest',
        'SampleRequestTest',
        'SampleResourceTest',
    ];

    /**
     * Returns the migration file name.
     *
     * @return string
     */
    public function getMigrationName(): string
    {
        return 'create_samples_table';
    }

    /**
     * Returns the count of the specified filename.
     *
     * @param string $filename
     * @return int
     */
    public function countFilesByName(string $filename): int
    {
        return sizeof(CoreComponentHelper::getFilesByDirectory($filename));
    }

    /**
     * Runs ComponentHelper to get all files for the specified component.
     *
     * @param string $componentName
     * @return array
     */
    public function getComponentFiles(string $componentName): array
    {
        $files = CoreComponentHelper::getFilesByDirectory($componentName);

        for ($i = 0; $i < sizeof($files); $i++) {
            $files[$i] = basename($files[$i]);
            $files[$i] = str_replace('.php', '', $files[$i]);
        }

        return $files;
    }

    /**
     * Deletes a component.
     */
    public function deleteSampleComponent(): void
    {
        File::deleteDirectory(
            CoreBundle::ComponentPath() . DIRECTORY_SEPARATOR . $this->sampleComponentName
        );
    }
}
