<?php

namespace App\Components\Menu\Database\Seeds;

use App\Components\Menu\Database\Menu;
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
