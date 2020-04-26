<?php

namespace MiPaPo\Core\Components\User\Database\Seeds;

use MiPaPo\Core\Components\User\Database\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, User::$seed_count - 1)->create();
    }
}
