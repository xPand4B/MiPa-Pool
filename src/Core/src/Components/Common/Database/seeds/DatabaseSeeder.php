<?php

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\CoreBundle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call(CoreBundle::getComponentSeeders()[2]);

        dd();

        $components = CoreComponentHelper::getComponentNames();

        $this->command->info("\nTotal:");
        $this->command->info("=============");

        foreach ($components as $component) {
            $splittedPath = explode(DIRECTORY_SEPARATOR, $component);
            $componentName = $splittedPath[sizeof($splittedPath) - 1];
            $modelClass = 'MiPaPo\Core\Components\\'.$componentName.'\Database\\'.$componentName;

            if (!class_exists($modelClass)) {
                continue;
            }

            $this->command->info("{$componentName}: " . $modelClass::all()->count());
        }

        $this->command->info('');

        Eloquent::reguard();
    }
}
