<?php

namespace MiPaPo\Core\System\Console\Commands;

use Illuminate\Foundation\Console\PackageDiscoverCommand as BaseCommand;
use Illuminate\Foundation\PackageManifest;

class PackageDiscoverCommand extends BaseCommand
{
    /**
     * @
     * @string
     */
    const VENDOR_PATH = 'src/vendor';

    /**
     * Execute the console command.
     *
     * @codeCoverageIgnore
     *
     * @param  \Illuminate\Foundation\PackageManifest  $manifest
     * @return void
     */
    public function handle(PackageManifest $manifest)
    {
        $manifest->vendorPath = base_path(self::VENDOR_PATH);

        parent::handle($manifest);
    }
}
