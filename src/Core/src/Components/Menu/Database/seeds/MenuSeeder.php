<?php

namespace MiPaPo\Core\Components\Menu\Database\Seeds;

use MiPaPo\Core\Components\Menu\Database\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Menu::class, Menu::$seed_count)->create();
    }
}
